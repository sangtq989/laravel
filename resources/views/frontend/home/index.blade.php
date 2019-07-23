@extends('frontend.layout')

@section('title', 'Home - blog')
@section('lastest-post', 'Lastest post')

@section('content')
<div class="row">
  @foreach($lastestPosts as $key => $value)
  <div class="col-md-6">
    <a href="blog-single.html" class="blog-entry element-animate" data-animate-effect="fadeIn">
      <img src="{{  URL::to('/') }}/upload/images/{{ $value['avatar'] }}" alt="{!! $value['title'] !!}">
      <div class="blog-content-body">

        <div class="post-meta">
          <span class="author mr-2">{{ $value['username'] }}</span>&bullet;
          <span class="mr-2">{{ $value['publish_date'] }}</span> &bullet;
          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
        </div>
        <h2>{!! $value['title'] !!}</h2>
      </div>
    </a>
  </div>
  @endforeach
</div>
<div class="row mt-5">
  <div class="col-md-12 text-center">
      {{ $paginate->links() }}
  </div>
</div>
@endsection