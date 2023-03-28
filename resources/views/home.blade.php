@extends('layouts.app')
@section('content')

@section('styles')
<style>
 
</style>
@endsection
<!-- -------search sec start here ----- -->
         <div class="search-sec">
            <div class="container">
			<div id="media_home_list">
               <div class="row  pt-4 pb-5">
			   
				  @forelse($media_contents as $media_content)
				  
					@if(!empty($media_content->categoryMedia->count()))	
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 pt-4">						 
							   <h4>{{ucfirst($media_content->name)}}</h4>
							   <hr style="margin-top: 0;">							 
					  </div>
					  @forelse($media_content->categoryMedia as $result)
						  
							  <div class="col-12 col-sm-12 col-md-3 col-lg-3">
								 <div class="item">
									<div class="card" style="width: 18rem;">
									   <img class="card-img-top" src="{{($result->file) ? asset('public/uploads/media_thumb/'.$result->thumbnail) : asset('public/front/images/water-1.png')}}" alt="Media image">
									   <div class="card-body">
										  <div><span class="media-part">Media</span></div>
										 <span class="post-date">Posted on : {{date('d M,Y',strtotime($result->created_at))}}</span>
										 <h5 class="card-title">{{$result->keywords}}</h5>
										 <p class="card-text">{{ Str::limit($result->description, 175) }}</p>
										 <div class="iten-bt">
										 
										 <a href="{{route('mediaDetail', [$result->id])}}" class="btn btn-primary">View</a>
										 <a download href="{{($result->file) ? asset('public/uploads/documents/'.$result->file) : 'javascript:void(0)'}}" class="btn btn-primary bt-download">Download</a>
									   </div>
									   </div>
									 </div>
								 </div>
							  </div>
							 
						  @empty
						  <div class="col-12 col-sm-12 col-md-12 col-lg-12">						 
								   <p>No Record Found aaa</p>							 
						  </div>
						  @endforelse
					@endif 
					  @empty
					  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
						 <p>No Record Found ss</p>	
					  </div>
					 
					  @endforelse
				  
                 </div>
               </div>
			   
			   <div id="publication_home_list" style="display:none">
               <div class="row  pt-4 pb-5">
                  
				  @forelse($publication_content as $media_content)	
						@if(!empty($media_content->categoryPublication->count()))	
					
					 
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 pt-4">						 
							   <h4>{{ucfirst($media_content->name)}}</h4>
							   <hr style="margin-top: 0;">							 
					  </div>
					  
						  @forelse($media_content->categoryPublication as $result)
							   
								  <div class="col-12 col-sm-12 col-md-3 col-lg-3">
									 <div class="item">
										<div class="card" style="width: 18rem;">
											 
												<img class="card-img-top" src="{{($result->thumbnail) ? asset('public/uploads/documents/'.$result->thumbnail) : asset('public/front/images/water-1.png')}}" alt="Publication media">
											
										   <div class="card-body">
											  <div><span class="publication-part">Publication</span></div>
											 <span class="post-date">Posted on : {{date('d M,Y',strtotime($result->created_at))}}</span>
											 <h5 class="card-title">{{$result->title}}</h5>
											 <p class="card-text">{{ Str::limit($result->description, 175) }}</p>
											 <div class="iten-bt">
											 <a href="{{route('publicationDetail', [$result->id])}}" class="btn btn-primary">View</a>
											 <a download href="{{($result->file) ? asset('public/uploads/documents/'.$result->file) : 'javascript:void(0)'}}" class="btn btn-primary bt-download">Download</a>
										   </div>
										   </div>
										 </div>
									 </div>
								  </div>
								  
							  @empty
							  <div class="col-12 col-sm-12 col-md-12 col-lg-12">						 
									   <p>No Record Found aaa</p>							 
							  </div>
							  @endforelse
						@endif 
					  @empty
					  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
						 <p>No Record Found ss</p>	
					  </div>
					 
					  @endforelse
				  
                 </div>
               </div>
			   
			   
            </div>
         </div>   

@endsection
@section('scripts')
<script>
$(document).ready(function(){
 
 $("#home-tab").click(function() {
 
   $("#publication_home_list").hide();
   $("#media_home_list").show(); 
 });
 $("#profile-tab").click(function() {
   $("#media_home_list").hide();
   $("#publication_home_list").show(); 
 });
});
</script>
@endsection