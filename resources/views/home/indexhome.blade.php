@extends('test-layout')

@section('content')
<div class="row py-5 bg-info">
			<div class="col-lg-12 col-xg-12">
				<h3 >This is home</h3>
				<p>Name: {{ $name }}</p>
				<p>Phone: {{ $phone }}</p>
			</div>
		</div>
@endsection