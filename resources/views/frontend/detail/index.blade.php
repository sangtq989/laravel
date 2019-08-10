@extends('frontend.layout')

@section('title', $detail['slug'].' - blog')
@push('scripts')
	<script type="text/javascript">
		$(function() {
			//tao ra 1 anh de thuc thi update countview
			var img = new Image(1,1);
			img.src = "{{ route('fr.viewCount',['id' => $detail['id']]) }}"
		})
	</script>
@endpush
@section('content')	

<div>
	<img src="{{ URL::to('/') }}/upload/images/{{ $detail['avatar'] }}" alt="Image" class="img-fluid mb-5">
	<div class="post-meta">
		<span class="author mr-2">{{ $detail['username'] }}</span>&bullet;
		<span class="mr-2">{{ $detail['publish_date'] }}</span> &bullet;
		<span class="ml-2"><span class="fa fa-comments"></span> 3</span>
	</div>
	<h1 class="mb-4">{{ $detail['title'] }}</h1>
	<a class="category mb-5" href="#">{{ $detail['cate_name'] }}</a>             
	<div class="post-content-body">
		{!! $detail['content_web'] !!}
	</div>


	<div class="pt-5">
		<p>Categories:  <a href="#">{{ $detail['cate_name'] }}</a></p>
		<p>Tags:
			@php
			$tags = '';		
			@endphp
			@foreach($tag as $value )
			@php
			$tags .= ($tags == '') ? "<a href='#'>#" . $value['name_tag'] . "</a>" : ',' . "<a href='#'>#" . $value['name_tag'] . "</a>";
			@endphp

			@endforeach
		{!! $tags !!}</p>
	</div>   
</div>
<section class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="mb-3 ">Related Post</h2>
			</div>
		</div>
		<div class="row">
			@foreach($relatedPost as $key => $value)
			<div class="col-md-6 col-lg-4">
				<a href="{{ route('fr.detail',['slug'=> $value['slug'],'id'=>$value['id']]) }}" class="a-block sm d-flex align-items-center height-md" style="background-image: url('{{ URL::to('/') }}/upload/images/{{ $value['avatar'] }}') ">
					<div class="text">
						<div class="post-meta">
							<span class="category">{{$value['name_cate']}}</span>
							<span class="mr-2">{{ $value['publish_date'] }}</span> &bullet;
							<span class="ml-2"><span class="fa fa-comments"></span> 3</span>
						</div>
						<h3>{!! $value['title'] !!}</h3>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
<div class="fb-comments" data-width="100%" data-numposts="5"></div>

@endsection