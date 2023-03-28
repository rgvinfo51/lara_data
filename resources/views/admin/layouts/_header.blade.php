<div class="logo-sec-wraper p-0">
               <div class="container-fluid">
                  <div class="d-flex justify-content-between flex-wrap align-items-center">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-4 logo-sec">
                         <a href="{{route('pnm.dashboard')}}" class="logo-align">
                           <img src="{{asset('public/img/photos/CGWBLogo.png')}}" alt="logo" />
                           <div class="brand-text">
                              <h4>Central Ground Water Board <span>Department of Water Resources,</span><span>River Development & Ganga Rejuvenation</span><span>
                                    MINISTRY OF JAL SHAKTI, GOVT OF INDIA</span></h4>
                           </div>
                        </a>
                     </div>
                     <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <nav class="navbar navbar-expand navbar-light navbar-bg">
				

			

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block logout-dropdown " href="#" data-toggle="dropdown">
                <img src="{{asset('public/img/avatars/avatar.jpg')}}" class="avatar img-fluid rounded mr-1" alt="Charles Hall" /><div class="logout-option"> <span class="text-dark">{{Auth::guard('misadmin')->user()->first_name}} {{Auth::guard('misadmin')->user()->last_name}}</span><span>Admin</span></div>
              </a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="{{route('pnm.profile')}}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{route('pnm.changePassword')}}"><i class="align-middle mr-1" data-feather="settings"></i> Settings & Privacy</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{route('pnm.logout')}}">Log out</a>
			</div>
			</li>
			</ul>
			</div>
			</nav>
                     </div>
                  </div>
               </div>
</div> 