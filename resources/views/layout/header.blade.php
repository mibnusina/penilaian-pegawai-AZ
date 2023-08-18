<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Pegawai</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/summernote/summernote-bs4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-buttons/css/buttons.bootstrap4.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist') }}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @php
        $jabatan = Auth::user()->jabatan;
        
    @endphp
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/logout') }}" role="button">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://www.agrabudikomunika.com/assets/images/logo_img_1.png" alt="AdminLTE Logo" class="" style="opacity: .8; width: 195px; padding-left: .8rem;">
      <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center;">
        <div class="image">
          <img src="{{ asset('dist') }}/img/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <div class="rows" style="display: flex; flex-direction: column;">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <a href="#" class="" style="font-size: 13px;" id="jabatan-header-text"></a>
            </div>
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @php
                  if (Auth::user()->jabatan == 17 || Auth::user()->jabatan == 18 || Auth::user()->jabatan == 1) {
                @endphp
              <li class="nav-item">
                <a href="{{ url('/jabatan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              @php } @endphp
              @php
                if (Auth::user()->jabatan == 17 || Auth::user()->jabatan == 1) {
              @endphp
              <li class="nav-item">
                <a href="{{ url('/pegawai') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>
              @php } @endphp
              @php
                if (Auth::user()->jabatan == 17 || Auth::user()->jabatan == 18) {
              @endphp
              <li class="nav-item">
                <a href="{{ url('/kriteria') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kriteria</p>
                </a>
              </li>
              @php } @endphp
              @php
                if (Auth::user()->jabatan == 17 || Auth::user()->jabatan == 17) {
              @endphp
              <li class="nav-item">
                <a href="{{ url('/sub-kriteria') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Kriteria</p>
                </a>
              </li>
              @php } @endphp
              @php
                if (Auth::user()->jabatan == 17 || Auth::user()->jabatan == 18) {
              @endphp
              <li class="nav-item">
                <a href="{{ url('/periode') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Periode</p>
                </a>
              </li>
              @php } @endphp
            </ul>
          </li>
          @php
            if (Auth::user()->jabatan == 5 || Auth::user()->jabatan == 8 || Auth::user()->jabatan == 9 || Auth::user()->jabatan == 1) {
          @endphp
          <li class="nav-item">
            <a href="{{ url('/penilaian') }}" class="nav-link">
              <i class="nav-icon fas fa-recycle"></i>
              <p>
                Penilaian Pegawai
              </p>
            </a>
          </li>
          @php } @endphp
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 Agrabudi Komunika.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins') }}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
  var jabatanId = '{{ Auth::user()->jabatan }}';
  var url = "{{ url('/') }}/jabatan/data-by-id/"+jabatanId
  var jabatanText = ''
  $.ajax({
      method: "get",
      url: url
  }).done(function(res){
      if (res.data != null) {
        jabatanText = res.data.nama_jabatan;
        $('#jabatan-header-text').html(res.data.nama_jabatan);
        $('#text-jabatan').html(jabatanText)
      } else {
        alert('Error baca data Jabatan!')
        return false
      }
  })
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins') }}/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins') }}/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins') }}/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('plugins') }}/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins') }}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins') }}/moment/moment.min.js"></script>
<script src="{{ asset('plugins') }}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('plugins') }}/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist') }}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('dist') }}/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist') }}/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->

@yield('other-js')

</body>
</html>
