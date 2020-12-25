<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Supplier | @if (Auth::user()->isAdmin)
    Admin
  @else
    {{Auth::user()->name}}
  @endif</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('alt/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Custom Inputs-->
  <link rel="stylesheet" href="{{asset('alt/plugins/select2/css/select2.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('alt/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"> --}}
  {{-- <link rel="stylesheet" href="{{asset('icheck/skins/all.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('alt/plugins/sweetalert2/sweetalert2.css')}}">
  <link rel="stylesheet" href="{{asset('/alt/plugins/toastr/toastr.min.css')}}">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{asset('alt/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <style media="screen">
  #ftco-loader {
    position: fixed;
    width: 96px;
    height: 96px;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.9);
    -webkit-box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
    border-radius: 16px;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: opacity .2s ease-out, visibility 0s linear .2s;
    -o-transition: opacity .2s ease-out, visibility 0s linear .2s;
    transition: opacity .2s ease-out, visibility 0s linear .2s;
    z-index: 1000; }

  #ftco-loader.fullscreen {
    padding: 0;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    -webkit-transform: none;
    -ms-transform: none;
    transform: none;
    background-color: #fff;
    border-radius: 0;
    -webkit-box-shadow: none;
    box-shadow: none; }

  #ftco-loader.show {
    -webkit-transition: opacity .4s ease-out, visibility 0s linear 0s;
    -o-transition: opacity .4s ease-out, visibility 0s linear 0s;
    transition: opacity .4s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1; }

  #ftco-loader .circular {
    -webkit-animation: loader-rotate 2s linear infinite;
    animation: loader-rotate 2s linear infinite;
    position: absolute;
    left: calc(50% - 24px);
    top: calc(50% - 24px);
    display: block;
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg); }

  #ftco-loader .path {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0;
    -webkit-animation: loader-dash 1.5s ease-in-out infinite;
    animation: loader-dash 1.5s ease-in-out infinite;
    stroke-linecap: round; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  @include('layouts.nav')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
          {{-- <div class="col-6">
            <button type="button" name="button" id="swaltest">fire</button>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      @yield('content')
    </section>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> v.0.01a
    </div>
    {{-- <strong>Copyright &copy; 2020 <a href="http://www.instagram.com/kimochiinside">KimochiInside</a>.</strong> All rights --}}
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- loader -->
{{-- <div id="ftco-loader" class="show fullscreen" style="background:rgba(0,0,0,.75); z-index:1000000000">
  <svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
  </svg>
</div> --}}
<!-- jQuery -->
{{-- <script src="{{asset('alt/plugins/jquery/jquery.min.js')}}"></script> --}}
<!-- Bootstrap 4 -->
<script src="{{asset('alt/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('alt/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Custom Inputs -->
<script src="{{asset('alt/plugins/select2/js/select2.full.js')}}"></script>
{{-- <script src="{{asset('icheck/icheck.js')}}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script> --}}
<script src="{{asset('/alt/plugins/sweetalert2/sweetalert2.all.js')}}" charset="utf-8"></script>
<script src="{{asset('/alt/plugins/toastr/toastr.min.js')}}"></script>
{{-- <script src="{{asset('/jquery.form.min.js')}}" charset="utf-8"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('alt/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('alt/dist/js/demo.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
@include('layouts.js')
</body>
</html>
