
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('assets/admins/images/logos/logo_gau-removebg-preview.png')}}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{asset('assets/admins/css/styles.min.css')}}" />
  @yield('css')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    
    @include('admins.blocks.sidebar')

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">


      <!--  Header Start -->
      @include('admins.blocks.header')
      <!--  Header End -->


      <div class="container-fluid">

        @yield('content')
        
      </div>
    </div>
  </div>

  {{-- @include('adminss.blocks.footer') --}}


  
  <script src="{{asset('assets/admins/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/admins/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/admins/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('assets/admins/js/app.min.js')}}"></script>
  <script src="{{asset('assets/admins/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/admins/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('assets/admins/js/dashboard.js')}}"></script>

  @yield('js')
</body>

</html>