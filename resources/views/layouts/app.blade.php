<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CGWB - Publications and Media Warehouse</title>
      <link href="{{ asset('public/front/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link href="{{ asset('public/front/css/font-awesome.min.css')}}" rel="stylesheet" />
      <link href="{{ asset('public/front/css/material.css')}}" rel="stylesheet" />
      <link href="{{ asset('public/front/css/owl.carousel.min.css')}}" rel="stylesheet" />
      <link href="{{ asset('public/front/css/owl.theme.default.css')}}" rel="stylesheet">
      <link href="{{ asset('public/front/css/animate.css')}}" rel="stylesheet">
      <link href="{{ asset('public/front/css/style.css')}}" rel="stylesheet" />
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	  @yield('styles') 
   </head>
   <body class="active-preloader-ovh">
      <div class="preloader">
         <div class="spinner"></div>
      </div>
      @include('layouts.header')
	    
	  @if(Route::currentRouteName() == 'home' || Route::currentRouteName() == 'searchMediaPublication')
		  @include('layouts.home_banner')
		@endif
      
	  @yield('content')
                     
      @include('layouts.footer')
   
      <!-- footer logo section -->
      <script src="{{ asset('public/front/js/jquery-3.3.1.min.js')}}"></script>
      <script src="{{ asset('public/front/js/bootstrap-4.2.1.js')}}"></script>
      <script src="{{ asset('public/front/js/jquery.easy-ticker.min.js')}}"></script>
      <script src="{{ asset('public/front/js/wow.min.js')}}"></script>
      <script src="{{ asset('public/front/js/owl.carousel.js')}}"></script>
      <script src="{{ asset('public/front/js/jquery.waypoints.min.js')}}"></script>
      <script src="{{ asset('public/front/js/jquery.counterup.min.js')}}"></script>
      <script src="{{ asset('public/front/js/custom.js')}}"></script>
	  @yield('scripts') 
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
         
                 // thmScrollAnim();
         
             })(jQuery);
         });
         
          
function showSelectedStateOptions($this,district_test_id)
{
	var arr = $($this).val();
	console.log(arr);
	if(arr == 'All')
	{
		 var option ='';
		 option +='<option value="">Select District...</option>';
		option +='<option value="All">All</option>';
		 $('#'+district_test_id).html(option);
	}else{
	$.ajax({
			url: "{{ route('getDistrictListByStates') }}",
			method: "POST",
			dataType: 'json',
			data: {
				'state_ids[]': arr,
				 
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				
				$('#'+district_test_id).html('');
				   var option ='';
				   option +='<option value="">Select District...</option>'; 
				   
				   if(result!=null){
						 $.each(result, function(i, item) {
							 console.log(item);
                          option +="<option value='"+item.district_code+"'>"+item.district_name+"</option>";
                      });
				   }
				 $('#'+district_test_id).html(option);
			}
		});
	}
}
      </script>
   </body>
</html>