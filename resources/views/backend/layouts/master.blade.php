<!DOCTYPE html>
<html lang="en">
<head>
  @include('backend.layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('backend/dist/img/loader.gif')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
    @include('backend.layouts.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('backend.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->
    
    @include('backend.layouts.footer')

</body>
</html>
