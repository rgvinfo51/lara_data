<div class="banner-section">
         <div class="container">
            <div class="row align-items-start mt-5">
               <div class="col-5">
                  <div class="banner-heading">
                     <h1><span>CGWB</span>Publications and <br/>Media Warehouse</h1>
                  </div>
               </div>
			   @php 
			   
				if(isset($_REQUEST['type']) && ($_REQUEST['type'] == 1))
				{
					$media = 'active';
					$punlication = '';
				}elseif(isset($_REQUEST['type']) && ($_REQUEST['type'] == 2))
				{
					$media = '';
					$punlication = 'active';
				}else{
					$media = 'active';
					$punlication = '';
				}
			   @endphp
			   
               <div class="col-12 col-sm-12 col-md-7">
                  <div class="tabination wow  fadeInUp animated" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link show  {{ $media }} " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Media</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link show  {{ $punlication }} " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Publication</a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane show {{$media }} " id="home" role="tabpanel" aria-labelledby="home-tab">
						<form action="{{route('searchMediaPublication')}}" method="get">
						<input type="hidden" name="type" value="1">
                           <div class="row">
                              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
								<div class="row">
                              <div class="col-4">
                                 <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">Choose Category</option>
										@foreach($categories as $category)
											<option {{( isset($_REQUEST['type']) && ($_REQUEST['type'] == 1) && $_REQUEST['cat_id'] == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
										@endforeach
                                 </select>
                              </div>
                              <div class="col-4">
                                 <select name="state_id" class="form-select form-control" id="stateSelect" onchange="showSelectedStateOptions(this,'districtSelect')">
                                    <option value="">Choose State</option>
									<option value="All">All</option>
                                    @foreach($states as $state)
										<option  {{( isset($_REQUEST['type']) && ($_REQUEST['type'] == 1) && $_REQUEST['state_id'] == $state->state_code) ? 'selected': ''}} value="{{$state->state_code}}">{{$state->state_name}}</option>
									@endforeach
                                 </select>
                              </div>
                              <div class="col-4">
                                 <select name="district_id" class="form-select form-control" id="districtSelect">
                                    <option value="">Choose District</option>
                                   {{--  @foreach($districts as $district)
										<option  {{( isset($_REQUEST['type']) && ($_REQUEST['type'] == 1) && $_REQUEST['district_id'] == $district->id) ? 'selected': ''}} value="{{$district->id}}">{{$district->district_name}}</option>
								   @endforeach --}}
                                 </select>
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="year_of_issue" type="text" class="form-control form-control" placeholder="Year Of Issue">
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="name_of_author" type="text"  class="form-control form-control" placeholder="Name of Author">
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="media_keywords" type="text" value="{{($_REQUEST['media_keywords']) ?? ''}}" class="form-control form-control" placeholder="Keywords">
                              </div>
                              <div class="col-12 text-right mt-3">
								<button type="submit" name="search" value="search" class="btn search-btn hvr-sweep-to-right">Search</button>
                                  
                              </div>
                           </div>
						    
                              </div>
                           </div>
						   </form>
                        </div>
                        <div class="tab-pane show  {{$punlication}} " id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<form action="{{route('searchMediaPublication')}}" method="get">
							<input type="hidden" name="type" value="2">
                           <div class="row">
                              <div class="col-4">
                                 <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">Choose Category</option>
										@foreach($categories as $category)
											<option {{( isset($_REQUEST['type']) && ($_REQUEST['type'] == 2) && $_REQUEST['cat_id'] == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
										@endforeach
                                 </select>
                              </div>
                              <div class="col-4">
                                 <select name="state_id" class="form-select form-control" id="stateSelect" onchange="showSelectedStateOptions(this,'districtSelect1')">
                                    <option value="">Choose State</option>
									<option value="All">All</option>
                                    @foreach($states as $state)
										<option  {{( isset($_REQUEST['type']) && ($_REQUEST['type'] == 2) && $_REQUEST['state_id'] == $state->state_code) ? 'selected': ''}} value="{{$state->state_code}}">{{$state->state_name}}</option>
									@endforeach
                                 </select>
                              </div>
                              <div class="col-4">
                                 <select name="district_id" class="form-select form-control" id="districtSelect1">
                                    <option value="">Choose District</option>
                                  {{--   @foreach($districts as $district)
										<option  {{(  isset($_REQUEST['type']) && ($_REQUEST['type'] == 2) && $_REQUEST['district_id'] == $district->id) ? 'selected': ''}} value="{{$district->id}}">{{$district->district_name}}</option>
								  @endforeach --}}
                                 </select>
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="year_of_issue" type="text" class="form-control form-control" placeholder="Year Of Issue">
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="name_of_author" type="text"  class="form-control form-control" placeholder="Name of Author">
                              </div>
                              <div class="col-4 mt-3">
                                 <input name="keywords" type="text" class="form-control form-control" placeholder="Keywords">
                              </div>
                              <div class="col-12 text-right mt-3">
								<button type="submit" name="search" value="search"  class="btn search-btn hvr-sweep-to-right">Search</button>
                                  
                              </div>
                           </div>
						   </form>
                        </div>
                     </div>
                  </div>
                  
                   
               </div>
            </div>
         </div>
         </div>