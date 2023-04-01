<div class="logo-sec-wraper">
         <div class="container">
            <div class="d-flex justify-content-between flex-wrap align-items-center">
               <div class="col-12 col-sm-12 col-md-12 col-lg-6 logo-sec">
                  <a href="{{route('home')}}" class="logo-align">
                     <img src="{{ asset('public/front/images/logo.png')}}" alt="emblem">
                     <div class="brand-text">
                        <h4>Central Ground Water Board (CGWB)<span>Ministry of Jal Shakti, Department of Water Resources, River </span></h4>
                        <p>Development and Ganga Rejuvenation<span>Government of India</span></p>
                     </div>
                  </a>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-6 menu-sec">
                  <div class="logo-sec-wraper">
                     <div class="d-flex justify-content-end">
                        <nav class="navbar navbar-expand-lg p-0">
                           <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false"> <i class="fas fa-bars"></i> </button>
                           <div class="navbar-collapse collapse" id="navb">
                              <ul class="navbar-nav ">
                                 <li class="nav-item {{	(Route::currentRouteName() == 'home') ? 'active' : ''}}"> <a class="nav-link " href="{{ route('home') }}">Home</a> </li>
                                 <li class="nav-item {{	(Route::currentRouteName() == 'media') ? 'active' : ''}}"> <a class="nav-link" href="{{ route('media') }}">Media</a> </li>
                                 <li class="nav-item {{	(Route::currentRouteName() == 'publications') ? 'active' : ''}}"> <a class="nav-link" href="{{ route('publications') }}">Publications</a> </li>
                                 
								 
								 
								 @if(Auth::guard('misadmin')->user())
								 <li class="nav-item {{	(Route::currentRouteName() == 'cgwbpnm') ? 'active' : ''}}"> <a class="nav-link" href="{{ route('admin.logout') }}">Logout</a> </li>
								 @else
									 <li class="nav-item {{	(Route::currentRouteName() == 'cgwbpnm') ? 'active' : ''}}"> <a class="nav-link" href="{{ route('cgwbpnm') }}">Login</a> </li>
								 @endif
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

  