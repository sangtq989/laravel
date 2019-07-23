<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Tags;
use App\Http\Requests\StorePosts as Posts;
use App\Http\Requests\UpdatePost;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    public function index(Request $request,AntiXSS $xss)
    {
        $data = [];
        $keyword=$request->keyword;
        $keyword = $xss->xss_clean($keyword);
        $listPost = DB::table('posts AS a')
            ->select('a.id','a.title','a.slug','a.sapo','a.publish_date','c.name','c.id as cate_id')
            ->join('categories AS c', 'a.categories_id','=','c.id')
            ->where(function($query) use ($keyword){
                $query->where('a.title','like',"%{$keyword}%");
                $query->orWhere('a.sapo','like',"%{$keyword}%");
                $query->orWhere('a.publish_date','like',"%{$keyword}%");
            })
            ->where('a.status', 1)          
            ->paginate(2);
            $mainData= json_decode(json_encode($listPost),true);
            // dd($mainData);
            //co 2 sp tren 1 trang
        $data['keyword']=$keyword;
        $data['listPost']=$mainData['data'] ?? [];
        $data['paginate'] = $listPost;
        // dd($data);

    	return view('admin.posts.list-post',$data);
    }
    public function createPosts(Categories $cat ,Tags $tag)
    {
    	//lay all data tu bang categories
    	
    	$data =[];
    	$data['cate'] = $cat->getAllDataCategories();
    	$data['tag'] = $tag->getAllDataTags();
   		return view('admin.posts.create-post',$data);
    }
    public function handleCreatePost(Posts $request)
    {
    	//dd($request->all());
        $title = $request->titlePost;
        $slug = Str::slug($title,'-');
        $sapoPost = $request->sapoPost;
        $contentPost = $request->contentPost;
        $language=$request->language;
        $categories =$request->categories;
        $tag = $request->tags;
        $userId= $request->session()->get('id');
        //dd($userId);


        //anh dai dien
        $avatar = $request->avatarPost;
        //kiem tra nguoi dung co upload file ko
        $nameFile = null;
        if ($request->hasFile('avatarPost')) {
            //kiem tra xem file co bi loi ko
            if ($request->file('avatarPost')->isValid()) {
                //thuc hien upload
                $file = $request->file('avatarPost');
                $nameFile=$file->getClientOriginalName();
                if ($nameFile) {
                    # code...
                   $upload= $file->move('upload/images',$nameFile);
                }
            }
        }
        //dd($upload,$nameFile);
        //upload thanh cong
        //INSERT data INTO posts
        $publish = $request->publishPost;
        $status = 0;
        if ($publish === 'on') {
            $status = 1;
            $publishDate = date('Y-m-d H:i:s');
        }

        $dataInsert=[
            'title'=> $title,
            'slug'=> $slug,
            'sapo'=> $sapoPost,
            'categories_id'=> $categories,
            'avatar' => $nameFile,
            'status'=> $status,
            'publish_date'=>$publishDate,
            'lang_id'=> $language,
            'user_id'=>$userId,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
        DB::table('posts')->insert($dataInsert);
        $idPost = DB::getPdo()->lastInsertId();

        //insert bang content
        $dataContent=[
            'post_id' => $idPost,
            'content_web'=>$contentPost,
            'content_mobile'=> null,
            'content_amp' => null,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => null 
        ];
        DB::table('contents')->insert($dataContent);

        //insert bang post tag
        if ($tag && is_array($tag)) {
            foreach ($tag as $key => $value) {
                DB::table('post_tag')->insert([
                    'posts_id' => $idPost,
                    'tag_id' => $value,
                    'primary' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null,
                ]);
            }
        }
        return redirect()->route('admin.listPosts');

    }
    public function deletePost(Request $request){
        if ($request->ajax()) {
            $idPost = $request->id;
            $idPost = is_numeric($idPost) && $idPost > 0 ? $idPost : 0;
            if ($idPost>0 ) {
                $up = DB::table('posts')->where('id',$idPost)->update(['status'=>0]);
                if ($up) {
                   echo "OK";
                }else{
                    echo "FAIL";
                }
            }else{
                echo "ERR";
            }
        }
    }
    public function editPost($slug, $id, Request $request, Categories $cat ,Tags $tag)
    {
       $id = is_numeric($id) && $id>0 ? $id :0;
       //lay du lieu 
       $post=DB::table('posts AS p')
            ->select('p.*','c.content_web')
            ->join('contents AS c','p.id','=','c.post_id')           
            ->where('p.id',$id)
            ->first();
        if ($post) {
            $data = [];
            $data['post'] = $post;
            $data['cate'] = $cat->getAllDataCategories();
            $data['tag'] = $tag->getAllDataTags();

            $post_tag=DB::table('post_tag')
                ->select('tag_id')
                ->where('posts_id',$id)
                ->get();
            $data['post_tag'] = json_decode($post_tag,true);
              $data['post_tag2']=[];
            foreach ($data['post_tag'] as $key => $val) {
                $data['post_tag2'][] = $val['tag_id'];

                # code...
            }
            // dd($data['post_tag2']);
            //thong bao loi upload
            $data['errUpload']=$request->session()->get('errImg');
           return view('admin.posts.edit-post',$data);

        }else{
            abort(404);
           // dd($post);
        }
    }
    public function handleEdit($id, UpdatePost $request)
    {
        $infoPost=DB::table('posts AS p')
            ->select('p.*','c.content_web')
            ->join('contents AS c','p.id','=','c.post_id')           
            ->where('p.id',$id)
            ->first();
        if ($infoPost) {
                $title = $request->titlePost;
                $slug = Str::slug($title,'-');
                $sapoPost = $request->sapoPost;
                $contentPost = $request->contentPost;
                $language=$request->language;
                $categories =$request->categories;
                $tag = $request->tags;
                //anh cu, neu ko thay anh moi thi van de anh cu
                $avatar = $infoPost->avatar;
                $arrAllowTypeImage=['image/jpeg','image/png','image/bmp','image/gif'];


                //nguoi dung muon thay anh moi


                if ($request->hasFile('avatarPost')) {
                    if ($request->file('avatarPost')->isValid()) {
                        //thuc hien upload
                        $file = $request->file('avatarPost');
                        $typeImg = $file->getClientMimeType();
                        // dd($typeImg);
                        if (in_array($typeImg,$arrAllowTypeImage)) {
                            # code...
                            $avatar=$file->getClientOriginalName();
                            $file->move('upload/images',$avatar);
                        }else{
                             //khong cho upload
                             $request->session()->flash('errImg','dinh dang anh khong dung'); 
                             //quay ve lai route edit
                             return redirect()->route('admin.editPost',[
                                'slug'=>$infoPost->slug,
                                'id'=>$id
                             ]);    

                        }
                    }      
                }

                $publish=$request->publishPost;
                $status=$infoPost->status;
                $publishDate=$infoPost->publish_date;
                if ($publish !== 'on') {
                    $status = 0;
                    //khong xuat ban bai viet
                }
                //tien hanh update post
                DB::table('posts')->where('id',$id)->update([
                    'title'=>$title,
                    'slug'=>$slug,
                    'sapo'=>$sapoPost,
                    'categories_id'=>$categories,
                    'avatar'=>$avatar,
                    'status'=>$status,
                    'lang_id'=>$language,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                //update contents
                DB::table('contents')->where('post_id',$id)->update([
                    'content_web'=>$contentPost,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                //update tag
                if ($tag && is_array($tag)) {
                    //cho phep update du lieu
                    // dd($arrPostTag);
            
                    DB::table('post_tag')->where('posts_id',$id)->delete();
                    
                    foreach ($tag as $key => $value) {
                        DB::table('post_tag')->insert([
                            'posts_id' => $id,
                            'tag_id' => $value,
                            'primary' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => null,
                        ]);
                    }
                   
                  
                    
                }else{
                    DB::table('post_tag')->where('posts_id',$id)->delete();
                    //xoa du lieu
                }
                //quay ve trang list
                return redirect()->route('admin.listPosts');


            }else{
                //ko thay bai viet quay ve dashboard
                return redirect()->route('admin.dashboard');
            }
      

        //update file (nguoi dung muon thayu doi anh)

    }
}
