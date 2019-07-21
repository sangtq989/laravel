@extends('admin.master')
@section('title','List')


@section('content')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
		<h1>danh sach bai viet</h1>
		

		<div class="row">
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
				<a href="{{ route('admin.createPosts') }}" class="btn btn-primary">viet bai</a>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
				<input type="text" id="txtKeyword" class="w-70 ml-5" placeholder="Tim kiem bai viet..." value="{{ $keyword }}"></input>
				<button type="button" class="btn btn-primary float-right" id="btnSearch">Tim kiem</button>
			</div>			
		</div>
		<div class="clearfix"></div>
		
 
		<table class="table mt-3">			
			<thead>
				<tr>
					<th>Id</th>
					<th>Tieu de</th>
					<th>Danh muc</th>
					<th>Publish date</th>
					<th colspan="2" width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($listPost as $key => $post)
				<tr>			
					
						<td>{{ $post['id'] }}</td>
						<td>
							<h5>{{ $post['title'] }}</h5>
							<p>{!! $post['sapo']  !!}</p>
						</td>
						<td>{{ $post['name']  }}</td>
						<td>{{ $post['publish_date']  }}</td>
						<td>
							<a href="{{ route('admin.editPost',['slug'=>$post['slug'],'id'=>$post['id']])}}" class="btn btn-info">Edit</a>
						</td>
						<td><button onclick="deletePost({{ $post['id'] }})" class="btn btn-danger">Delete</button></td>
					
					
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row justify-content-center boder-top py-3">
			{{-- hien tri phan trang --}}
			{{-- phan trang va tim kiem --}}
			{{-- appen them nhung param  --}}
			{{ $paginate->appends(request()->query())->links() }}
		</div>
		
	</div>

</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(function(){
			$('#btnSearch').click(function(){
				let keyword = $('#txtKeyword').val().trim();
				if (keyword.length > 0 ) {
					window.location.href = "{{ route('admin.listPosts') }}" + "?keyword=" + keyword;
				}
			})
		})
		function deletePost(idPost) {
			if (Number.isInteger(idPost)) {
				$.ajax({
					url: "{{ route('admin.deletePost') }}",
					type:'post',
					data:{id:idPost},
					success:function (data) {
					 data=$.trim(data);
						 if (data === 'FAIL' || data === 'ERR') {
						 	alert('xoa ko dc');

						}else if (data === 'OK'){
							alert('thnah cong');
							window.location.reload(true);
						}
						return false;
					}
				});
			}
		}
	</script>
@endpush