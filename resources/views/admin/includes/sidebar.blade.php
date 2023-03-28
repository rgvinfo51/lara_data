@php
$currentUrl = \Route::currentRouteName();
@endphp
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('public/assets/images/cgwb-logo.png')}}" width="230px" >
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>


            <!-- Sidebar start -->
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('admin.dashboard')}}"  >
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>

                        </li> <!-- end Dashboard Menu -->
                    
						<!-- User management -->
			@can('admin_access')
                           <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarorganizations" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Admin</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.admin.index' || $currentUrl == 'admin.admin.edit' || $currentUrl == 'admin.admin.create' || $currentUrl == 'admin.roles.index' || $currentUrl == 'admin.roles.edit' || $currentUrl == 'admin.roles.create' || $currentUrl == 'admin.roles.show' ) ? 'show' : '' }}" id="sidebarorganizations">
                                <ul class="nav nav-sm flex-column">                                   
                                    <li class="nav-item">
                                        <a href="{{route('admin.admin.index')}}" class="nav-link {{($currentUrl == 'admin.admin.index' || $currentUrl == 'admin.admin.create' || $currentUrl == 'admin.admin.edit' ) ? 'active' : '' }}" data-key="t-crm"> Admin List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.admin.index')}}" class="nav-link {{($currentUrl == 'admin.admin.index' ) ? 'active' : '' }}" data-key="t-crm"> Logged User </a>
                                    </li>

									<li class="nav-item">
                                        <a href="{{route('admin.roles.index')}}" class="nav-link {{($currentUrl == 'admin.roles.index' || $currentUrl == 'admin.roles.edit' || $currentUrl == 'admin.roles.create' || $currentUrl == 'admin.roles.show') ? 'active' : '' }}" data-key="t-crm"> Role </a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                    @endcan
                    
                    @can('agent_access')
						<!-- Role management End -->
						 <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Agent List</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.admin-agents.index' || $currentUrl == 'admin.admin-agents.edit' || $currentUrl == 'admin.admin-agents.create' || $currentUrl == 'admin.admin-agents.show' ) ? 'show' : '' }}" id="sidebarPages">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('admin.admin-agents.index')}}" class="nav-link {{($currentUrl == 'admin.admin-agents.index' || $currentUrl == 'admin.admin-agents.edit' || $currentUrl == 'admin.admin-agents.create' || $currentUrl == 'admin.admin-agents.show') ? 'active' : '' }}" data-key="t-crm"> Agent List </a>
                                    </li>
									<!-- <li class="nav-item">
                                        <a href="{{route('admin.permissions.index')}}" class="nav-link {{($currentUrl == 'admin.permissions.index' || $currentUrl == 'admin.permissions.edit' || $currentUrl == 'admin.permissions.create') ? 'active' : '' }}" data-key="t-crm">Permission </a>
                                    </li>  -->

                                </ul>
                            </div>
                        </li>
			@endcan	
                        @can('support_access')
						<li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarSupportList" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSupportList">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Support List</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.supports.index' || $currentUrl == 'admin.supports.edit' || $currentUrl == 'admin.supports.create' || $currentUrl == 'admin.category.show' || $currentUrl == 'admin.permissions.index' || $currentUrl == 'admin.permissions.edit' || $currentUrl == 'admin.permissions.create') ? 'show' : '' }}" id="sidebarSupportList">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('admin.supports.index')}}" class="nav-link {{($currentUrl == 'admin.supports.index' || $currentUrl == 'admin.supports.create' || $currentUrl == 'admin.supports.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Support List </a>
                                    </li>
									 
                                </ul>
                            </div>
                        </li>
			@endcan	
                        
                        
						<li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAggrement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAggrement">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Aggrement Report</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show' || $currentUrl == 'admin.permissions.index' || $currentUrl == 'admin.permissions.edit' || $currentUrl == 'admin.permissions.create') ? 'show' : '' }}" id="sidebarAggrement">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Pending List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Approved List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Reject List </a>
                                    </li>
									 
                                </ul>
                            </div>
                        </li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarWorkReport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarWorkReport">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Work Report</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show' || $currentUrl == 'admin.permissions.index' || $currentUrl == 'admin.permissions.edit' || $currentUrl == 'admin.permissions.create') ? 'show' : '' }}" id="sidebarWorkReport">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> User List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Plan List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Data List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Active User </a>
                                    </li>
									 
                                </ul>
                            </div>
                        </li>
						
						<li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarTaskReport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTaskReport">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Task Report</span>
                            </a>
                            <div class="collapse menu-dropdown {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show' || $currentUrl == 'admin.permissions.index' || $currentUrl == 'admin.permissions.edit' || $currentUrl == 'admin.permissions.create') ? 'show' : '' }}" id="sidebarTaskReport">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Completed List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Non-Completed List </a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link {{($currentUrl == 'admin.category.index' || $currentUrl == 'admin.category.edit' || $currentUrl == 'admin.category.create' || $currentUrl == 'admin.category.show') ? 'active' : '' }}" data-key="t-crm"> Report Release List </a>
                                    </li>
									 
                                </ul>
                            </div>
                        </li>
                    
                    @can('publication_access')
						<li class="nav-item">
                            <a class="nav-link menu-link {{($currentUrl == 'admin.publications.index' || $currentUrl == 'admin.publications.edit' || $currentUrl == 'admin.publications.create' || $currentUrl == 'admin.publications.show') ? 'active' : '' }}" href="{{route('admin.publications.index')}}"  >
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Publications</span>
                            </a>

                        </li> <!-- end Letter and order Menu -->
                    @endcan
                    @can('media_access')
						<li class="nav-item">
                            <a class="nav-link menu-link {{($currentUrl == 'admin.media-content.index' || $currentUrl == 'admin.media-content.edit' || $currentUrl == 'admin.media-content.create' || $currentUrl == 'admin.media-content.show') ? 'active' : '' }}" href="{{route('admin.media-content.index')}}"  >
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Media Content</span>
                            </a>

                        </li> <!-- end Minutes of Meetings Menu -->
                    @endcan
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('admin.logout')}}"  >

								<i class="ri-logout-box-r-line"></i> <span data-key="t-dashboards">Logout</span>

                            </a>

                        </li> <!-- end LOgout Menu -->


                    </ul>
                </div>

            </div>
 <!-- Sidebar end -->


            <div class="sidebar-background"></div>
        </div>
