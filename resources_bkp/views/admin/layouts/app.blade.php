<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name') }} -  @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name') }} -  @yield('title')" name="description" />
    <meta content="RGV" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico')}}">
	
	 <!-- dropzone css -->
    <link rel="stylesheet" href="{{ asset('public/assets/libs/dropzone/dropzone.css')}}" type="text/css" />

    <!-- Filepond css -->
    <link rel="stylesheet" href="{{ asset('public/assets/libs/filepond/filepond.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
 <!-- Layout config Js -->
    <script src="{{ asset('public/assets/js/layout.js')}}"></script>
	
	
	<script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
	
   
    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('public/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> 
	<script> var base_url = "{{  url('') }}"</script>
	<style>
	.dataTables_length,.dataTables_filter {
		display: inline-flex;
	}
	#example_paginate,#example_filter,.dataTables_filter{float:right;}
	.form-control:focus,.form-select:focus
	{
		border-color: #fa5661;
	}
	table.dataTable thead th, table.dataTable tbody td {
   /*  white-space: nowrap; */
    border: 1px solid #e3e3e3;
    border-collapse: collapse;
    border-right: 0;
    border-bottom: 0;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #e3e3e3;
}
	</style>
	@yield('style')
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.includes.header')
        <!-- ========== App Menu ========== -->
		
		@include('admin.includes.sidebar')
		<!-- Left Sidebar End -->        
        
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> 
                        </div>
                        {{--<div class="col-sm-6">--}}
                            {{--<div class="text-sm-end d-none d-sm-block">--}}
                                {{--Design & Develop by Velocis--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{ asset('public/assets/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('public/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('public/assets/js/pages/dashboard-crm.init.js')}}"></script>

{--	
	<!-- dropzone min -->
    <script src="{{ asset('public/assets/libs/dropzone/dropzone-min.js')}}"></script>
    <!-- filepond js -->
    <script src="{{ asset('public/assets/libs/filepond/filepond.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>
 --}}
	
    <!-- App js -->
    <script src="{{ asset('public/assets/js/app.js')}}"></script>
	<script src="{{ asset('public/assets/js/custom.js')}}"></script>
	<script src="{{ asset('public/assets/scripts/choices.min.js')}}"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	 <script src="{{ asset('public/backend/js/sweetalert.js')}}"></script>

	@yield('script')
	@include('sweetalert::alert')
	
</body> 
</html>
 
 
