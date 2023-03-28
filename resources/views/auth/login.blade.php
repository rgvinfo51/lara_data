<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta charset="utf-8" />
    <title>Sign In | Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CGWB - Publications and Media Warehouse" name="description" />
    <meta content="CGWB - Publications and Media Warehouse" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('public/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('public/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
	<script> var base_url = "{{  url('') }}"</script>
</head>

<body>
    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="{{ route('home') }}" class="d-block">
                                                    <img src="{{ asset('public/assets/images/cgwb-logo.png') }}" alt="" >
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" CGWB - Publications and Media Warehouse "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" CGWB - Publications and Media Warehouse."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" CGWB - Publications and Media Warehouse "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue to CGWB - Publications and Media Warehouse.</p>
											@if (session('error'))
												<div class="alert alert-danger">
												{{ session('error') }}
												</div>
											@endif
											@if (session('success'))
												<div class="alert alert-success">
												{{ session('success') }}
												</div>
											@endif
                                        </div>
                                        <div class="mt-4">
											<form method="POST" action="{{ route('admin.login') }}" class="w-100" id="login_frm" autocomplete="off">
												@csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
													@error('email')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
                                                </div>
                                                <div class="mb-3">
													@if (Route::has('password.request'))
														<div class="float-end">
															<a href="#" class="text-muted">{{ __('Forgot Your Password?') }}</a>
														</div>
													@endif
                                                    <label class="form-label" for="password-input">{{ __('Password') }}</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">

														<input id="password-input" type="password" class="password-input form-control @error('password') is-invalid @enderror pe-5" name="password" required autocomplete="off">
														<button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
														@error('password')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
                                                    </div>
                                                </div>
												 
                                                <div class="form-check">
                                                    <input name="remember_me" class="form-check-input" type="checkbox" value="1" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">{{ __('Remember me') }}</label>
                                                </div>
                                                <div class="mt-4">
													<input type="submit" value="Login" class="btn btn-success w-100 login-y mt-4 login_frm"  />
                                                    <!-- <button class="btn btn-success w-100" type="submit">{{ __('Sign In') }}</button> -->
                                                </div>



                                            </form>
                                        </div>

                                       <!-- <div class="mt-5 text-center">
                                            <p class="mb-0">{{ __("Don't have an account ?") }} <a href="#" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                             <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> CGWB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
	<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('public/assets/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('public/assets/js/pages/password-addon.init.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/backend/js/sha.js') }}"></script>
	@include('sweetalert::alert')

	<script>
function handlePreloader() {
		 if($('.preloader').length){
			 $('body').removeClass('active-preloader-ovh');
			 $('.preloader').fadeOut();
		 }
	 }


	 jQuery(window).on('load', function() {
		 (function($) {
			 handlePreloader()
		 })(jQuery);
    });

@php $salt = rand('1000','9999');
session(['salt' => $salt]);
@endphp

$(document).ready(function(){
	$('.changelogin').click(function(){
		var checkedval=$(this).val();
		if(checkedval=='Login'){
			$('#login_frm').show();
			$('#registerform').hide();
		}else{
			$('#login_frm').hide();
			$('#registerform').show();
		}
	});
});

$(".btn-refresh").click(function(){
	$.ajax({
        type:'GET',
        url:'{{ route('refresh_captcha') }}',
        success:function(data){
            $(".captcha span").html(data);
        }
    });
});

$(document).on('submit','#login_frm',function(){
   // var salt = '{{ $salt }}';
    //var secret = $('#password-input').val();
    //var shaObj = new jsSHA("SHA-256", "TEXT");
    //shaObj.update(secret);
    //var hashPass = shaObj.getHash("HEX");
    //var shaObj1 = new jsSHA("SHA-256", "TEXT");
    //shaObj1.update(hashPass+salt);
    //var hashSalt = shaObj1.getHash("HEX");
    //$('#password-input').val(hashSalt);
});
</script>

</body>
</html>


