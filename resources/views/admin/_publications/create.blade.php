@extends('admin.layouts.app')
@section('title', 'Create Publications')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">New Publications</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
						<li class="breadcrumb-item active">New Publications</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('route' => 'admin.publications.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
 <div class="row">
	<div class="col-lg-12">
		<div class="card">
			 @if (count($errors) > 0)
			  <div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
				   @foreach ($errors->all() as $error)
					 <li>{{ $error }}</li>
				   @endforeach
				</ul>
			  </div>
			@endif
			
			{{--<div class="card-header align-items-center d-flex">--}}
				{{--<h4 class="card-title mb-0 flex-grow-1">User Detail</h4>--}}
				 {{----}}
			{{--</div>--}}
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">	
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Category') }} *</label>
								<select name="category_id" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($categories as $category)
										<option  {{(old('category_id') == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
									@endforeach									 
									 
								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="stateSelect" class="form-label">{{ __('State') }} *</label>
								<select name="state_id[]" multiple class="form-select" data-choices data-choices-groups id="stateSelect" onchange="showSelectedStateOptions(this)" required>
									<option value="">Choose State...</option>
									<option value="All">All</option>
									@foreach($states as $state)
										<option  {{(old('state_id') == $state->state_code) ? 'selected': ''}} value="{{$state->state_code}}">{{$state->state_name}}</option>
									@endforeach

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="districtSelect" class="form-label">{{ __('District') }} *</label>
								<select name="district[]" multiple class="form-select" data-choices data-choices-groups id="districtSelect" onchange="showSelectedDistrictOptions(this)" required>
									<option value="">Select District...</option>
									{{--	@foreach($districts as $district)
										<option  {{(old('category_id') == $district->id) ? 'selected': ''}} value="{{$district->id}}">{{$district->district_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="blockSelect" class="form-label">{{ __('Block') }} *</label>
								<select name="block[]" multiple class="form-select" data-choices data-choices-groups id="blockSelect" required>
									<option value="">Select Block...</option>
									{{--	@foreach($blocks as $block)
										<option  {{(old('block') == $block->id) ? 'selected': ''}} value="{{$block->id}}">{{$block->block_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="yearOfIssue" class="form-label">{{ __('Year of Issue') }} *</label>
								<input type="text" maxLength='4' autocomplete="off" placeholder="YYYY" min="1999" max="{{date('Y')}}" name="year_of_issue" class="form-control" id="yearOfIssue" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{old('year_of_issue')}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="title" class="form-label">{{ __('Title') }} *</label>
								<input type="text" name="title" autocomplete="off" class="form-control" id="title" value="{{old('title')}}" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="numberOfAuthors" class="form-label">{{ __('Number of Authors') }} *</label>
								<input type="text" name="number_of_authors" autocomplete="off" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" id="numberOfAuthors" value="{{old('number_of_authors')}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="nameOfAuthors" class="form-label">{{ __('Name of Authors') }} *</label>
								<input type="text" name="name_of_authors" autocomplete="off" class="form-control" id="nameOfAuthors" value="{{old('name_of_authors')}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="keywords" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" autocomplete="off" class="form-control" id="keywords" value="{{old('keywords')}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="thumbnail" class="form-label">{{ __('Thumbnail') }} * (Only For jpg/jpeg)</label>
								<input type="file" name="thumbnail" class="form-control" accept="image/*" id="thumbnail" value="{{old('thumbnail')}}" required onchange="image_validate(this)">
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="file" class="form-label">{{ __('Document') }} * (Only For pdf 15 MB)</label>
								<input type="file" name="file" class="form-control" id="file" accept="application/pdf" value="{{old('file')}}" required>
							</div>
						</div>
						@can('approve_media_publication')
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status') == '1') ? 'selected': ''}} value="1">Approve</option>
									<option {{(old('status') == '0') ? 'selected': ''}} value="0">Not Approved</option>
								</select>
							</div>
						</div>
						@else
							<input type="hidden" name="status" value="0">
						 @endcan

						<!--end col-->
						<div class="col-xxl-12 col-md-12">
							<div>
								<label for="description" class="form-label">{{ __('Description') }} *</label>
								<textarea name="description" class="form-control">{{ old('description') }}</textarea>
							</div>
						</div>
						 <!--end col-->

						
						{{--<div class="col-xxl-3 col-md-6">--}}
							{{--<div>--}}
								{{--<label for="labelNumberOfUsers" class="form-label">{{ __('Upload Doc (pdf)') }} *</label>--}}
								{{--<div id="dropzone" class="dropzone" >--}}
								 {{----}}
								{{--</div>--}}
                                    {{--<div class="hidden_images_logo"><input type="hidden" name="logo_hidden_images" value="{{ old('logo_hidden_images') }}"/>--}}
                                    {{--</div>--}}
								 {{----}}
							{{--</div>--}}
						{{--</div>--}}
						 
						<!--end col-->
						 	  
								
					</div>
				</div>
			</div>
		</div>
	</div>
	@can('approve_media_publication')
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
		</div>
	 @else
		 <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			 <button type="submit" class="btn btn-primary">{{ __('Submit for Approval') }}</button>
		 </div>
	 @endcan
</div>
  

{!! Form::close() !!}



</div> 
@endsection
@section('script')
 
<script>
function showSelectedStateOptions($this)
{
	var arr = $($this).val();
	if(arr == 'All')
	{
		 var option ='';
		option +='<option value="All">All</option>';
		$('#districtSelect').html(option);
		$('#blockSelect').html('');
	}else{
	$.ajax({
			url: "{{ route('admin.publications.getDistrictListByStates') }}",
			method: "POST",
			dataType: 'json',
			data: {
				'state_ids': arr,
				 
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				
				$('#districtSelect').html('');
				   var option ='';
				   option +='<option value="">Select District...</option>'; 
				   
				   if(result!=null){
						 $.each(result, function(i, item) {
							 console.log(item);
                          option +="<option value='"+item.district_code+"'>"+item.district_name+"</option>";
                      });
				   }
				 $('#districtSelect').html(option);
			}
		});
	}
}

function showSelectedDistrictOptions($this)
{
	var arr = $($this).val();
	console.log(arr);
	if(arr == 'All')
	{
		 var option ='';
		option +='<option value="All">All</option>';
		$('#blockSelect').html(option);
	}else{
	$.ajax({
			url: "{{ route('admin.publications.getBlockListByStates') }}",
			method: "POST",
			dataType: 'json',
			data: {
				'district_ids': arr,
				 
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				
				$('#blockSelect').html('');
				   var option ='';
				   option +='<option value="">Select Block...</option>'; 
				   
				   if(result!=null){
						 $.each(result, function(i, item) {
							 console.log(item);
                          option +="<option value='"+item.block_code+"'>"+item.block_name+"</option>";
                      });
				   }
				 $('#blockSelect').html(option);
			}
		});
	}
}

function image_validate(feature_image){
	//alert(feature_image);
        var flName = document.getElementById(""+feature_image+"").value;
        var flParts = flName.split(".");
        var flExtn = flParts[flParts.length - 1].toLowerCase();
        if(flExtn != "jpg"  && flExtn != "jpeg")
        {
            alert("You can only upload images (jpeg/jpg).");
            document.getElementById(""+feature_image+"").value="";
        }
    }

</script>

@endsection
