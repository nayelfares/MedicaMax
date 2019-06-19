<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Medica Max</title>
		<meta name="description" content="Abo obe | medicamax | drug management ">
		<meta name="author" content="Alaa Naseer Batha - http://medicamax.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}">
		<!-- Switchery css -->
		<link href="{{ asset('/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
		

		<!-- Bootstrap CSS -->
		<link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
		<!-- CSFR token for ajax call -->
    	<meta name="_token" content="{{ csrf_token() }}"/>


		
</head>
<style type="text/css">
	.solid {border-style: solid; border-width: 0.5px;}
</style>

<body class="adminbody">

<div id="main">

   @include('layouts.header')
    
 
    @include('layouts.sidebar')


    
      @yield('content')     


    
	@include('layouts.footer')

</div>
<!-- END main -->
<script src="{{ asset('/assets/js/modernizr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/moment.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('/assets/js/detect.js') }}"></script>
<script src="{{ asset('/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.nicescroll.js') }}"></script>

<!-- BEGIN Java Script for this page -->
    <script src="{{asset('/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Counter-Up-->
    <script src="{{ asset('/assets/plugins/waypoints/lib/jquery.waypoints.min.js') }}"=></script>
    <script src="{{ asset('/assets/plugins/counterup/jquery.counterup.min.js') }}"></script>        
    <!-- App js -->
<script src="{{ asset('/assets/js/pikeadmin.js')}}"></script>
<!-- END Java Script for this page -->  

<script src="{{asset('/assets/js/detect.js')}}"></script>
<script src="{{asset('/assets/js/fastclick.js')}}"></script>
<script src="{{asset('/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('/assets/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('/assets/plugins/switchery/switchery.min.js')}}"></script>


</body>
</html>