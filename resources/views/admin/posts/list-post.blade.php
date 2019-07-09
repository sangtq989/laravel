@extends('admin.master')
@section('title','Create')


@section('content')
<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
		<h1>danh sach bai viet</h1>
		<a href="{{ route('admin.createPosts') }}" class="btn btn-primary">viet bai</a>
	</div>

</div>
@endsection