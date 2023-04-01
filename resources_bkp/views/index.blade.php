<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="images/mot_logo_1.png" type="image/png" />
		<title>UTSAV - India a Land of Festivals | A Ministry of Tourism Initiative </title>
		<link href="{{asset('public/css/bootstrap.min.css') }}" rel="stylesheet" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<link href="{{asset('public/css//font-awesome.min.css') }}" rel="stylesheet" />
		<link href="{{asset('public/css/material.css') }}" rel="stylesheet" />
		<link href="{{asset('public/css/glyphicons.css') }}" rel="stylesheet" />
		<link href="{{asset('public/css/owl.carousel.min.css') }}" rel="stylesheet" />
		<link href="{{asset('public/css/owl.theme.default.css') }}" rel="stylesheet">
		<link href="{{asset('public/css/animate.css') }}" rel="stylesheet">
		<link href="{{asset('public/css/style.css') }}" rel="stylesheet" />
	</head>
<body class="landing-page">
	<div class="app ">
		<div class="preloader">
		   <div class="spinner"></div>
		</div>
		<div class="preloader">
		<div class="spinner"></div>
	</div>
<header>
<div class="top-header">
		<div class="container container-fluid-2">
			<div class="row align-items-center ">
			<div class="col-12 col-sm-5 col-md-5 col-lg-5 left-nav">
					{{--<ul>
						<li><a href="javascript:void(0);">भारत सरकार</a></li>
						<li><a href="javascript:void(0);">GOVERNMENT OF INDIA</a></li>
					</ul>	--}}							
			</div>
				<div class="col-12 col-sm-7 col-md-7 col-lg-7 top-right-nav">
					<ul>
					{{--<li>
							<a href="javascript:void(0);" class="hide">Skip to Main Content</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="hide">Screen Reader Access </a>
						</li>
											
						@auth('admin')
							<li>
								<a href="{{route('admin.dashboard')}}" class="">Post Events </a>
							</li>
							<li>
								<a href="{{route('admin.dashboard')}}" class="login-hm">Login as Event Organizer </a>
							</li>
							<li>
								<a href="{{route('admin.dashboard')}}" class="login-hm">Login as MOT Officer </a>
							</li>						    
						@else
							<li>
								<a href="{{route('user.login','post_event')}}" class="">Post an Events </a>
							</li>
							<li>
								<a href="{{route('user.login')}}" class="login-hm">Login as Event Organizer </a>
							</li>
							<li>
								<a href="{{route('login')}}" class="login-hm">Login as MOT Officer </a>
							</li>						    
						@endauth--}}				
						<li class="nobdr lang">
							<select class="changeLang">
								<option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>	
								<option value="hn" {{ session()->get('locale') == 'hn' ? 'selected' : '' }}>Hindi</option>
								
							</select>
						</li>
					</ul>
				</div>
			</div>
		</div>
</div>
	<div id="wrapperNav" class="">
	<div class="logo-sec-wraper">
		<div class="container container-fluid-2">
			<div class="d-flex justify-content-between flex-wrap align-items-center">
				<div class="col-12 col-sm-12 col-md-3 col-lg-3 logo-sec">
					<div class="logoaling">
						<a class="logo-align" href="{{url('/')}}" title="Home" rel="home">
							<img src="{{ asset('public/images/landing-logo2.png.png') }}" alt="Home">
						</a>		
						<p><a href="https://amritmahotsav.nic.in/" target="_blank"><img alt="akm" src="{{asset('public/images/akm-inner.png') }}" class="align-right"></a></p>								
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-7 col-lg-7 d-flex justify-content-center  search-sec">
					<nav class="navbar navbar-expand-lg">
						<button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
							<i class="fas fa-bars"></i>
						</button>
						<div class="navbar-collapse collapse" id="navb">
							<ul class="navbar-nav ">
								<li class="nav-item"><a class="nav-link is-active" href="{{url('/')}}">Home</a></li>
								<li class="nav-item"><a class="nav-link " href="{{route('events-festivals')}}">Events &amp; Festivals</a></li>		
								<li class="nav-item"><a class="nav-link " href="{{route('livedarshan')}}">Live Darshan</a></li>						                                
							</ul>
						</div>
                    </nav>
				</div>
				<div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex justify-content-end search-sec2">
					<section id="block-toprightlogo">
						<a href="https://amritmahotsav.nic.in/" target="_blank"><img alt="akm" src="{{asset('public/images/akm-inner.png') }}"></a>
					</section>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- main menu -->
</header>
		<div class="landingpage mot-landing-page-bg">
			<div class="container container-fluid-2">
				<div class="row">
					<div class="col-12 col-sm-5 col-md-5">
						<h1><img alt="Festival India" src="{{asset('public/images/india.png') }}" tile="Festival India"></h1>
						<p class="description">Come and experience our incredible festivals.<br>
						Indian fairs and festivals are the major attraction<br>
						and best way to explore India.</p>
						<p class="description">India is a land of festivals and fairs. In India,<br>
						every region, every season and every religion<br>
						has plenty to celebrate.&nbsp;</p>
					 
						<a href="javascript:void(0)" data-toggle="modal" data-target="#explore"><span class="mdi mdi-play"></span> Play Video </a> 
						<!-- <a href="{{route('user.login')}}">Post Events <span class="right-arrow">→</span></a>  -->
					</div>
					<div class="col-12 col-sm-7 col-md-7">
						<div class="moduleboxsection">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12">
									<div class="row justify-content-end">
										<div class="col-sm-6  boxpadding padding-right15">
											<div class="imgbg">
												<a class="link" href="{{url('events-festivals')}}">
													<img alt="f" src="{{asset('public/images/landing-festival_img.png') }}">
												</a>
											</div>
											<div class="caption">
												<h2><a class="link" href="{{url('events-festivals')}}">events &amp; festivals </a></h2>
											</div>
										</div>
										<div class="col-sm-6 boxpadding">
											<div class="imgbg">
												<a class="link" href="{{url('livedarshan')}}">
													<img alt="d" src="{{asset('public/images/landing-darshan_img.png') }}">
												</a>
											</div>
											<div class="caption">
												<h2><a class="link" href="{{url('livedarshan')}}">Live Darshan</a></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer style="background:#fff;margin-top:5px">
			<div class="footer">
				<div class="container container-fluid-2">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 borderfooter">
							<div class="row">
								<div class="col-12 col-md-3 col-lg-3">
									<img alt="logo" src="{{asset('public/images/ministry-logo.png') }}">
								</div>
								<div class="col-12 col-md-8  col-lg-8">
									<!-- <p><a aria-controls="collapseExample" aria-expanded="false" class="btn btn-primary collapsed" data-toggle="collapse" href="#collapseExample" role="button">Disclaimer</a></p> -->
									<div aria-expanded="false"  id="collapseExample11" style="height: 0px;">
										<div class="card card-body">
											<p><strong>Disclaimer:- </strong>The information available in this website has been supplied to Ministry of Tourism by event organisers and is subject to changes. Readers are advised to check with the venue or event organiser before relying in any way on the details published here.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>		
	</div>
<!-- footer logo section -->
	  <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
      <script src="{{asset('public/js/bootstrap-4.2.1.js')}}"></script>
      <script src="{{asset('public/js/jquery.easy-ticker.min.js')}}"></script>
      <script src="{{asset('public/js/wow.min.js')}}"></script>
      <script src="{{asset('public/js/owl.carousel.js')}}"></script>
      <script src="{{asset('public/js/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('public/js/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('public/js/custom.js')}}"></script>
<script>
    var url = "{{ route('changeLang') }}";
		$(".changeLang").change(function(){
			window.location.href = url + "?change_language="+ $(this).val();
		});
   function handlePreloader() {
       if($('.preloader').length){
           $('body').removeClass('active-preloader-ovh');
           $('.preloader').fadeOut();
       }
   }
   
   
   jQuery(window).on('load', function() {
       (function($) {
           handlePreloader()
   
           // thmScrollAnim();
   
       })(jQuery);
   });
   
   
   /* preloader */
</script>

	<!-- Modal -->
<div class="modal fade" id="explore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
    </div>
  </div>
</div>
		<style>
		#explore .modal-dialog {
    max-width: 70%;
	}
	#explore .modal-header{background: #871687;}
	#explore .modal-header .close{color: #fff;opacity:1;}
	
		</style>
</body>
</html>