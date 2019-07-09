@extends('admin.master')
@section('title','Create post')
@push('styles')
	<link rel="stylesheet" href="{{ asset('admin/css/multiple-select.css') }}">
@endpush

@push('scripts')
	<script type="text/javascript" src="{{ asset('admin/js/multiple-select.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/js/post.js') }}"></script>
@endpush

@section('content')
<style type="text/css">
	#tags {
		width: 88%;
	}
</style>
<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
		<h1>Tao bai viet</h1>
		@if ($errors->any())
		    <div class="alert alert-danger my-3">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form action="{{ url('admin/handle') }}" method="POST" class="mt-3 w-100" enctype="multipart/form-data">
		@csrf
			<div class="row">
				<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
					<div class="form-group">
						<label for="titlePost">Title</label>
						<input type="text" class="form-control" id="titlePost" name="titlePost" >
					</div>
					<div class="form-group">
						<label for="sapoPost">Sapo</label>
						<textarea class="form-control" id="sapoPost" name="sapoPost"></textarea>  
					</div>
					<div class="form-group">
						<label for="avatarPost">Thumbnail</label>
						<input type="file" class="form-control" id="avatarPost" name="avatarPost">  
					</div>
					<div class="form-group">
						<label for="contentPost">Content</label>
						<textarea class="form-control" id="contentPost" name="contentPost" rows="10"></textarea>  
					</div>

				</div>
				<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="language">Language</label>
						<select class="form-control" name="language" id="language">
							<option value="0">English</option>
							<option value="1">Tieng viet</option>
						</select>
					</div>
					<div class="form-group">
						<label for="categories">Danh muc</label>
						<select class="form-control" name="categories" id="categories">
							<option>---Choose categories</option>
							@foreach($cate as $key => $value)
								<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="tags">Tag</label>
						<select name="tags" id="tags" multiple="multiple">
							
							@foreach($tag as $key => $value)
								<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Publish date</label>
						<input type="checkbox" class="ml-3" checked="checked">
					</div>
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
		</form>
	</div>

</div>
@endsection