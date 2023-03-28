<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <title>CGWB - Publications and Media Warehouse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CGWB - Publications and Media Warehouse" name="description">
    <meta content="CGWB" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico')}}">

    <!--Swiper slider css-->
    <link href="{{ asset('public/assets/css/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Layout config Js -->
    <script src="{{ asset('public/assets/js/layout.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ asset('public/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

<!-- Begin page -->
<div class="layout-wrapper landing">
    <nav class="navbar navbar-expand-lg navbar-landing navbar-light fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="70">
                <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" class="card-logo card-logo-light" alt="logo light" height="70">
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('media') }}">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publications') }}">Publications</a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">Categories</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">Creators</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cgwbpnm') }}">Login</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="bg-overlay bg-overlay-pattern"></div>
    <!-- end navbar -->

    <!-- start hero section -->
    <section class="section nft-hero" id="hero" style="padding-bottom: 20px!important;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 formdesign text-center">
                    <div class="text-center">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="row justify-content-md-center">

                                        <div class="col-md-12" style="margin-right: -20px;">
                                            {{--<select name="type"  class="form-select form-control-lg bg-light border-light" style="height: 48px;">--}}
                                                {{--<option value="">{{ __('Choose...') }}</option>--}}
                                                {{--<option value="media">Media</option>--}}
                                                {{--<option value="publication">Publication</option>--}}
                                            {{--</select>--}}

                                            <label id="mediaLabel" class="mb-2"> <input type="radio" name="type" value="media" id="type">
                                            Media</label>

                                            <label id="publicationLabel" class="mb-2"><input type="radio" name="type" value="publication" id="type">
                                            Publication</label>


                                        </div>

                                        <div class="col-md-5" style="margin-right: -35px; display: none;" id="mediaFilter">
                                            <input type="text" id="keyword" class="form-control form-control-lg bg-light border-light" placeholder="Search here..">
                                        </div>
                                        <div class="col-md-3 publicationFilter" style="display: none;" id="publicationFilter">
                                            <select name="cat_id" class="form-select form-control-lg bg-light border-light" id="catSelect">
                                                <option value="">Choose Category</option>
                                                @foreach($categories as $category)
                                                    <option {{(old('cat_id') == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-3  publicationFilter" style="display: none;" id="publicationFilter">
                                            <select name="state_id" class="form-select form-control-lg bg-light border-light" id="stateSelect">
                                                <option value="">Choose State</option>
                                                @foreach($states as $state)
                                                    <option  {{(old('state_id') == $state->id) ? 'selected': ''}} value="{{$state->id}}">{{$state->state_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-3 publicationFilter" style="display: none;" id="publicationFilter">
                                            <select name="district_id" class="form-select form-control-lg bg-light border-light" id="districtSelect">
                                                <option value="">Choose District</option>
                                                @foreach($districts as $district)
                                                    <option  {{(old('district_id') == $district->id) ? 'selected': ''}} value="{{$district->id}}">{{$district->district_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-3 publicationFilter" style="display: none;" id="publicationFilter">
                                            <input type="text" id="year_of_issue" class="form-control form-control-lg bg-light border-light" placeholder="Year Of Issue">
                                        </div>
                                        <div class="col-md-3 publicationFilter" style="display: none;" id="publicationFilter">
                                            <input type="text" id="name_of_author" class="form-control form-control-lg bg-light border-light" placeholder="Name of Author">
                                        </div>
                                        <div class="col-md-3 publicationFilter" style="display: none;" id="publicationFilter">
                                            <input type="text" id="keywords" class="form-control form-control-lg bg-light border-light" placeholder="Keywords">
                                        </div>
                                        <div class="col-lg-12" id="searchButtonBefore">
                                            <button type="button" onclick="searchData()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="mdi mdi-magnify me-1"></i> Search</button>
                                        </div>

                                    <div class="col-md-2 mt-1" id="searchButtonAfter" style="display: none;">
                                        <button type="button" onclick="searchData()" class="btn btn-primary btn-lg waves-effect waves-light"><i class="mdi mdi-magnify me-1"></i> Search</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <h3 class="display-4 fw-medium mb-4 lh-base text-white" style="font-size: 1.5rem!important;">CGWB - Publications and Media Warehouse</h3>
                        <p class="lead text-white-50 lh-base mb-4 pb-2">CGWB - Publications and Media Warehouse</p>
                    </div>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero section -->
    <section class="section" id="wallet" style="padding: 10px!important;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card crm-widget">
                        <div class="card-body p-0">
                            <div class="row row-cols-md-3 row-cols-1">
                                <div class="col col-lg border-end">
                                    <div class="py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Images <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-image-2-line display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $images->count() }}">{{ $images->count() }}</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg border-end">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Videos <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-movie-line display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $videos->count() }}">{{ $videos->count() }}</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg border-end">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">
                                            Reports <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-file-2-line display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $publications->count() }}">{{ $publications->count() }}</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>
    </section><!-- end hero section -->

    <section class="section" style="padding: 10px!important;">
        <div class="container">
            {{--<div class="product-img-slider sticky-side-div">--}}
                {{--<div class="swiper product-thumbnail-slider p-2 rounded bg-light swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">--}}
                    {{--<div class="swiper-wrapper" id="swiper-wrapper-e3dc10641d0be3fc1" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">--}}
                        {{--<div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4" style="width: 348px; margin-right: 24px;">--}}
                            {{--<img src="{{ asset('public/assets/images/products/img-8.png') }}" alt="" class="img-fluid d-block">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 4" style="width: 348px; margin-right: 24px;">--}}
                            {{--<img src="{{ asset('public/assets/images/products/img-6.png') }}" alt="" class="img-fluid d-block">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide" role="group" aria-label="3 / 4" style="width: 348px; margin-right: 24px;">--}}
                            {{--<img src="{{ asset('public/assets/images/products/img-1.png') }}" alt="" class="img-fluid d-block">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide" role="group" aria-label="4 / 4" style="width: 348px; margin-right: 24px;">--}}
                            {{--<img src="{{ asset('public/assets/images/products/img-8.png') }}" alt="" class="img-fluid d-block">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-e3dc10641d0be3fc1" aria-disabled="false"></div>--}}
                    {{--<div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-e3dc10641d0be3fc1" aria-disabled="true"></div>--}}
                    {{--<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>--}}
                {{--<!-- end swiper thumbnail slide -->--}}
                {{--<div class="swiper product-nav-slider mt-2 swiper-initialized swiper-horizontal swiper-pointer-events swiper-free-mode swiper-watch-progress swiper-backface-hidden swiper-thumbs">--}}
                    {{--<div class="swiper-wrapper" id="swiper-wrapper-10a93b8d20fd463cc" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">--}}
                        {{--<div class="swiper-slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" role="group" aria-label="1 / 4" style="width: 83.5px; margin-right: 10px;">--}}
                            {{--<div class="nav-slide-item">--}}
                                {{--<img src="{{ asset('public/assets/images/products/img-8.png') }}" alt="" class="img-fluid d-block">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide swiper-slide-visible swiper-slide-next" role="group" aria-label="2 / 4" style="width: 83.5px; margin-right: 10px;">--}}
                            {{--<div class="nav-slide-item">--}}
                                {{--<img src="{{ asset('public/assets/images/products/img-6.png') }}" alt="" class="img-fluid d-block">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide swiper-slide-visible" role="group" aria-label="3 / 4" style="width: 83.5px; margin-right: 10px;">--}}
                            {{--<div class="nav-slide-item">--}}
                                {{--<img src="{{ asset('public/assets/images/products/img-1.png') }}" alt="" class="img-fluid d-block">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide swiper-slide-visible" role="group" aria-label="4 / 4" style="width: 83.5px; margin-right: 10px;">--}}
                            {{--<div class="nav-slide-item">--}}
                                {{--<img src="{{ asset('public/assets/images/products/img-8.png') }}" alt="" class="img-fluid d-block">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>--}}
                {{--<!-- end swiper nav slide -->--}}
            {{--</div>--}}
            <div class="tab-pane active show" id="video">
                <div class="row">
                    <div class="col-lg-12 video-list" id="searchResult">

                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>

    <!-- Start footer -->
    <footer class="custom-footer bg-dark py-5 position-relative" style="padding: 10px !important;">
        <div class="container">
            {{--<div class="row">--}}
                {{--<div class="col-lg-4 mt-4">--}}
                    {{--<div>--}}
                        {{--<div>--}}
                            {{--<img src="{{ asset('public/assets/images/cgwb-logo.png')}}" alt="logo light" height="50">--}}
                        {{--</div>--}}
                        {{--<div class="mt-4">--}}
                            {{--<p>CGWB</p>--}}
                            {{--<p>CGWB</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-lg-7 ms-lg-auto">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-4 mt-4">--}}
                            {{--<h5 class="text-white mb-0">Company</h5>--}}
                            {{--<div class="text-muted mt-3">--}}
                                {{--<ul class="list-unstyled ff-secondary footer-list">--}}
                                    {{--<li><a href="#">About Us</a></li>--}}
                                    {{--<li><a href="#">Gallery</a></li>--}}
                                    {{--<li><a href="#">Projects</a></li>--}}
                                    {{--<li><a href="#">Timeline</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-4 mt-4">--}}
                            {{--<h5 class="text-white mb-0">Apps Pages</h5>--}}
                            {{--<div class="text-muted mt-3">--}}
                                {{--<ul class="list-unstyled ff-secondary footer-list">--}}
                                    {{--<li><a href="#">Calendar</a></li>--}}
                                    {{--<li><a href="#">Mailbox</a></li>--}}
                                    {{--<li><a href="#">Deals</a></li>--}}
                                    {{--<li><a href="#">Kanban Board</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-4 mt-4">--}}
                            {{--<h5 class="text-white mb-0">Support</h5>--}}
                            {{--<div class="text-muted mt-3">--}}
                                {{--<ul class="list-unstyled ff-secondary footer-list">--}}
                                    {{--<li><a href="#">FAQ</a></li>--}}
                                    {{--<li><a href="#">Contact</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}

            <div class="row text-center text-sm-start align-items-center">
                <div class="col-sm-6">

                    <div>
                        <p class="copy-rights mb-0">
                            <script> document.write(new Date().getFullYear()) </script> © CGWB
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-github-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-linkedin-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-google-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-dribbble-line"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top" style="display: none;">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

</div>
<!-- end layout wrapper -->


<!-- JAVASCRIPT -->
<script src="{{ asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('public/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('public/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{ asset('public/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('public/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/toastify.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/scripts/choices.min.js')}}"></script>
<!--Swiper slider js-->
<script src="{{ asset('public/assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('public/assets/js/nft-landing.init.js')}}"></script>

<!-- apexcharts -->
<script src="{{ asset('public/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Vector map-->
<script src="{{ asset('public/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
<script src="{{ asset('public/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>
<script src="{{ asset('public/assets/libs/jsvectormap/maps/us-merc-en.js')}}"></script>
<!-- Dashboard init -->
<script src="{{ asset('public/assets/js/pages/dashboard-crm.init.js')}}"></script>


<script src="{{ asset('public/assets/js/pages/widgets.init.js')}}"></script>
<!-- App js -->
<script src="{{ asset('public/assets/js/custom.js')}}"></script>
<script src="{{ asset('public/assets/scripts/choices.min.js')}}"></script>
<script src="{{ asset('public/backend/js/sweetalert.js') }}"></script>
@include('sweetalert::alert')
<script>

    $(document).click('#type', function(){
        var type = $('input:radio[name=type]:checked').val();
        if(type=='media'){
            $('#mediaFilter').show();
            $('.publicationFilter').hide();
            $('#searchButtonAfter').show();
            $('#searchButtonBefore').hide();
        }else{
            $('#mediaFilter').hide();
            $('.publicationFilter').show();
            $('#searchButtonAfter').show();
            $('#searchButtonBefore').hide();
        }
    })

    function searchData() {
        var type = $('input:radio[name=type]:checked').val();
        let keyword;
        if(type == 'media'){
            keyword = $('#keyword').val();
        }else{
            keyword = $('#keywords').val();
        }
        if (!type) {
            swal.fire('Please select type');
            return false;
        }
       /*  if (!keyword) {
            swal.fire('Please input keyword');
            return false;
        } */
        $.ajax({
            url : '{{ route("getSearchResult") }}',
            type : 'post',
            data : {'type': type,'keyword': keyword},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
                $('#searchResult').html(response);
            }
        });
    }
</script>
</body></html>