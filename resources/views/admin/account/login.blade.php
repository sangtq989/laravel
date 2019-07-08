<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">ADMIN login</div>
      <div class="card-body">
        <form action="{{ route('admin.handleLogin') }}" method="post">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Email address"  autofocus="autofocus" name="email">
              <label for="inputEmail">Email or username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password">
              <label for="inputPassword">Password</label>
            </div>
          </div>
        
          <button type="submit" class="btn btn-primary btn-block">Login</button>
          
        </form>
       
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

</body>

</html>
