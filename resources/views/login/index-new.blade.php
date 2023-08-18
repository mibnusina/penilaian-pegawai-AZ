<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - PT. Agrabudi Komunika</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: radial-gradient(circle, #ee39a0, #df379f, #cf349d, #c0339a, #b03197, #ad2e9b, #aa2c9f, #a62aa4, #ae26b3, #b522c2, #bb1ed2, #c01ae3);">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="#"><b>Aplikasi </b>Manajemen Pegawai</a> -->
    <img src="https://www.agrabudikomunika.com/assets/images/logo_img_1.png" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Aplikasi </b>Manajemen Pegawai</p>

      <form action="{{ route('action-login') }}" method="post">
        @if(session('error'))
        <div class="alert alert-danger">
            <b>Opps!</b> {{session('error')}}
        </div>
        @endif
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="nik" class="form-control" placeholder="NIK" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist') }}/js/adminlte.min.js"></script>
</body>
</html>
