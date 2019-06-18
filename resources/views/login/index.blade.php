<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>demo index view </title>
</head>
<body>


	<form action="{{ route('handleLogin') }}" method="post">
		@csrf
	{{-- 	khi method khong phai la get bat buoc phai co @csrf --}}
		<label for="user">Username</label>
		<input type="text" name="user" id="user">
		<br><br>
		<label for="pass">Password</label>
		<input type="text" name="pass" id="pass">
		<br><br>
		<button type="submit" name="btnSubmit" id="btnSubmit">Login</button>
	</form>
</body>
</html>