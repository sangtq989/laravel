<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>demo master layout view</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	@stack('style')
</head>
<body>
	<div class="container">
		@include('partrials/header')
		@include('partrials/navbar')
		
		@yield('content')
		@include('partrials/footer')
		
		{{-- doi cac ma js dc dinh nghia o cac template con dc day ra ngoai view --}}
		@stack('scripts')
	</div>
</body>
</html>