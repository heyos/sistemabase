<!DOCTYPE html>
<html class="loading">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Potente sistema para la creacion dinamica de tu menu de navegacion de tu proximo sistema web.">
  <meta name="keywords" content="admin template, menu manager, menu_manager">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>EasyOrder - @yield('title') </title>
  <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="{{asset('css/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/line-awesome/css/line-awesome-font-awesome.min.css')}}" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/vendors.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/ui/prism.min.css')}}">
  
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-compact-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/morris.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-5.3.1/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/rowReorder.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/extensions/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
  <!-- END Custom CSS-->
</head>

{{-- <body class="horizontal-layout horizontal-menu 2-columns  menu-expanded pace-done" data-open="hover" data-menu="horizontal-menu" data-col="2-columns"> --}}

<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

  <div id="preloader">
    <div class="text-center " id="status">
        <img src="{{ asset('Preloader.gif') }}" alt="Preloader" class="img-responsive" style="margin: 0 auto">
    </div>
  </div>

  @include('layouts.menu.navbar')
  @include('layouts.menu.menu')

  <div class="app-content content">
    <input type="hidden" id="slug" value="{{ $slug }}">
    @yield('content')
  </div>
</div>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
{{-- <script src="{{asset('mainJs/default.js')}}"></script> --}}
<!-- BEGIN VENDOR JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/raphael-min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/morris.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('app-assets/js/scripts/ui/breadcrumbs-with-stats.js')}}"></script>
{{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-sales.js')}}" type="text/javascript"></script> --}}

<!-- END PAGE LEVEL JS-->
{{-- <script src="{{asset('js/jquery-ui-1-11-4/jquery-ui.min.js')}}"></script> --}}
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/jquery.alphanum.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/bootbox.all.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>

<script src="{{asset('js/main/main.js')}}"></script>
{{-- <script src="{{ asset('js/main/ejemplo.js') }}"></script> --}}
@yield('script')

</body>

</html>