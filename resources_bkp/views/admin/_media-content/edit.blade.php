@extends('admin.layouts.app')
@section('title', 'Edit Letter/Order')

@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Media Content</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.media-content.index') }}">Media Content</a></li>
						<li class="breadcrumb-item active">Edit Media Content</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->

 {!! Form::model($mom, ['method' => 'PATCH','route' => ['admin.media-content.update', $mom->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
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

			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Media Content Detail</h4>

			</div>

			<div class="card-body">
				<div class="live-preview">


					<div class="row gy-4">
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Category') }} *</label>
								<select name="cat_id" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($categories as $category)
										<option {{($mom->cat_id == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
									@endforeach

								</select>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="stateSelect" class="form-label">{{ __('State') }} *</label>
								<select name="state_id" class="form-select" id="stateSelect" required onchange="showSelectedStateOptions(this)">
									<option value="">Choose...</option>
									<option value="All">All</option>
									@foreach($states as $state)
										<option  {{($mom->state_id == $state->state_code) ? 'selected': ''}} value="{{$state->state_code}}">{{$state->state_name}}</option>
									@endforeach

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="districtSelect" class="form-label">{{ __('District') }} *</label>
								<select name="district_id[]" multiple class="form-select" data-choices data-choices-groups id="districtSelect" onchange="showSelectedDistrictOptions(this)" required>
									<option value="">Choose...</option>
									{{--	@foreach(getDistrictByStateID($mom->state_id) as $district)
										<option {{ (in_array($district->id, explode(',',$mom->district_id) )) ? 'selected' : '' }} value="{{$district->id}}">{{$district->district_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="blockSelect" class="form-label">{{ __('Block') }} *</label>

								<select name="block[]" multiple class="form-select" data-choices data-choices-groups id="blockSelect" required>
									<option value="">Choose...</option>

									{{-- @foreach(getBlockByByDistrictID($mom->district_id) as $block)
										<option {{ (in_array($block->id, explode(',',$mom->block) )) ? 'selected' : '' }} value="{{$block->id}}">{{$block->block_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="location" class="form-label">{{ __('Location') }} *</label>
								<input type="text" name="location" class="form-control" id="location" value="{{$mom->location}}" autocomplete="off" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="x" class="form-label">{{ __('X') }} *</label>
								<input type="text" name="x" class="form-control" id="x" value="{{$mom->x}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" autocomplete="off" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="y" class="form-label">{{ __('Y') }} *</label>
								<input type="text" name="y" class="form-control" id="y" value="{{$mom->y}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" autocomplete="off" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="publication_date" class="form-label">{{ __('Publication Date') }} *</label>
								<input type="date" name="publication_date" class="form-control" id="publication_date" value="{{$mom->publication_date}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="keywords" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" class="form-control" id="keywords" value="{{$mom->keywords}}" autocomplete="off" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="thumbnail" class="form-label">{{ __('Thumbnail') }} *</label>
								@if(!empty($mom->thumbnail))
								<a target="_blank" href="{{ asset('public/uploads/media_thumb')}}/{{ $mom->thumbnail }}">View Document</a>
								@endif
								<input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png,image/jpg" id="thumbnail" value="{{old('thumbnail')}}">
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="image_caption" class="form-label">{{ __('Image Caption') }} *</label>
								<input type="text" name="image_caption" class="form-control" id="image_caption" value="{{$mom->image_caption}}" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="typeOfFile" class="form-label">{{ __('Type of File') }}*</label>
								<select name="type_of_file" class="form-select" id="typeOfFile" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{($mom->type_of_file == '1') ? 'selected': ''}} value="1">Video</option>
									<option {{($mom->type_of_file == '0') ? 'selected': ''}} value="0">Image</option>
								</select>
							</div>
						</div>
						<!--end col-->
						@can('approve_media_publication')
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{($mom->status == '1') ? 'selected': ''}} value="1">Approve</option>
									<option {{($mom->status == '0') ? 'selected': ''}} value="0">Not Approved</option>
								</select>
							</div>
						</div>
						@else
							<input type="hidden" name="status" value="{{ $mom->status }}">
						@endcan
						<!--end col-->
						<div class="col-xxl-6 col-md-6">
							<div>
								<label for="description" class="form-label">{{ __('Description') }}*</label>
								<textarea name="description" class="form-control">{{ $mom->description }}</textarea>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload File') }} *</label>
								<div id="dropzone1" class="dropzone" >

								</div>
								<div class="upload_final_ppt_file"><input type="hidden" name="upload_file" value="{{ old('upload_final_ppt_file',$mom->file) }}"/>
								</div>
								@if(!empty($mom->file))
									<a class="btn btn-primary" target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $mom->file }}">View Document</a>
								@endif
							</div>
						</div>





					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
	</div>
</div>


{!! Form::close() !!}



</div>
@endsection
@section('script')
<script>
 // Dropzone has been added as a global variable.

	  new Dropzone("#dropzone1", {
        url: "{{route('admin.media-content.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
		addRemoveLinks: true,
        acceptedFiles: ".mp4,.mkv,.avi,.jpg,.jpeg,.png",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
				this.on("sending", function(file, xhr, formData) {
				  formData.append("type", "0");
				  console.log(formData)
				});
                this.on('error', function (file, errorMessage) {
                    if (errorMessage.indexOf('Error 404') !== -1) {
                        var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                        errorDisplay[errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
                    }
                    if (errorMessage.indexOf('File is too big') !== -1) {
                        alert('Unable to upload image size is greated than 2 MB');
                        // i remove current file
                        drop.removeFile(file);
                    }
                });
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                }),
                this.on("success", function (file, response) {
                    console.log(response);
                    var hiddenImage = $('<input type="hidden" name="upload_file" value="' + response.name + '"/>');
                    $('.upload_final_ppt_file').html(hiddenImage);
                })
            }
    });

</script>


<script>
$state = $('#stateSelect');
showSelectedStateOptions($state);

function showSelectedStateOptions($this)
{
	var arr = $($this).val();
	console.log(arr);
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
				'state_ids[]': arr,

			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				
				var districts = '{{$mom->district_id}}';
				var distrct_ids = districts.split(',').map(Number);
				var selected = '';
				 
				$('#districtSelect').html('');
				$('#blockSelect').html('');
				   var option ='';
				   option +='<option value="">Select District...</option>';

				   if(result!=null){
						 $.each(result, function(i, item) {
							 var district_code = item.district_code;							 
							 if(jQuery.inArray(district_code, distrct_ids) !== -1)
							 {
								 selected = 'selected';
							 }else{
								 selected = '';
							 }
                          option +="<option "+selected+" value='"+item.district_code+"'>"+item.district_name+"</option>";
                      });
				   }
				 $('#districtSelect').html(option);
				 $districts = $('#districtSelect');				 
				showSelectedDistrictOptions($districts);
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
				var blocks = '{{$mom->block}}';
				var block_ids = blocks.split(',').map(Number);
				var selected = '';
				
				$('#blockSelect').html('');
				   var option ='';
				   option +='<option value="">Select Block...</option>';

				   if(result!=null){
						 $.each(result, function(i, item) {
							var block_code = item.block_code;							 
							 if(jQuery.inArray(block_code, block_ids) !== -1)
							 {
								 selected = 'selected';
							 }else{
								 selected = '';
							 }
                          option +="<option "+selected+" value='"+item.block_code+"'>"+item.block_name+"</option>";
                      });
				   }
				 $('#blockSelect').html(option);
			}
		});
	}
}

</script>

@endsection
