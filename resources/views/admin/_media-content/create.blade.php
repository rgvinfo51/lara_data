@extends('admin.layouts.app')
@section('title', 'Create Media Content')

@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">New Media Content</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.media-content.index') }}">Media Content</a></li>
						<li class="breadcrumb-item active">New Media Content</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('route' => 'admin.media-content.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
										<option {{(old('cat_id') == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
									@endforeach

								</select>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="stateSelect" class="form-label">{{ __('State') }} *</label>
								<select name="state_id" class="form-select" id="stateSelect" onchange="showSelectedStateOptions(this)" required>
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
								<select name="district_id[]" multiple class="form-select" data-choices data-choices-groups id="districtSelect"  onchange="showSelectedDistrictOptions(this)" required>
									<option value="">Select District...</option>
								{{--	@foreach($districts as $district)
										<option  {{(old('district_id') == $district->id) ? 'selected': ''}} value="{{$district->id}}">{{$district->district_name}}</option>
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
								<label for="location" class="form-label">{{ __('Location') }} *</label>
								<input type="text" name="location" autocomplete="off" class="form-control" id="location" value="{{old('location')}}" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="x" class="form-label">{{ __('X') }} *</label>
								<input type="text" name="x" autocomplete="off" class="form-control" id="x" value="{{old('x')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="y" class="form-label">{{ __('Y') }} *</label>
								<input type="text" name="y" autocomplete="off" class="form-control" id="y" value="{{old('y')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="publication_date" class="form-label">{{ __('Publication Date') }} *</label>
								<input type="date" name="publication_date" class="form-control" id="publication_date" value="{{old('publication_date')}}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="keywords" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" class="form-control" id="keywords" value="{{old('keywords')}}" autocomplete="off" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="thumbnail" class="form-label">{{ __('Thumbnail') }} * (Only For jpg/jpeg/png)</label>
								<input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png" id="thumbnail" value="{{old('thumbnail')}}" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="image_caption" class="form-label">{{ __('Image Caption') }} *</label>
								<input type="text" name="image_caption" class="form-control" id="image_caption" value="{{old('image_caption')}}" autocomplete="off" required>
							</div>
						</div>
						 <!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="typeOfFile" class="form-label">{{ __('Type of File') }}*</label>
								<select name="type_of_file" class="form-select" id="typeOfFile" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status') == '1') ? 'selected': ''}} value="1">Video</option>
									<option {{(old('status') == '0') ? 'selected': ''}} value="0">Image</option>
								</select>
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
						<div class="col-xxl-6 col-md-6">
							<div>
								<label for="description" class="form-label">{{ __('Description') }}*</label>
								<textarea name="description" class="form-control">{{ old('description') }}</textarea>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload File') }} *</label>
								<div id="dropzone" class="dropzone" >

								</div>
                                    <div class="upload_minutes_file">
										<input type="hidden" name="upload_file" value="{{ old('file') }}"/>
                                    </div>

							</div>
						</div>





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
 // Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", {
        url: "{{route('admin.media-content.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
		addRemoveLinks: true,
        acceptedFiles: ".mp4,.mkv,.avi,.jpg,.jpeg,.png",
       // contentType : 'image/png',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
				this.on("sending", function(file, xhr, formData) {
				  formData.append("type", "1");
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
                    $('.upload_minutes_file').html(hiddenImage);
                })
            }
    });



</script>

<script>
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

				$('#districtSelect').html('');
				$('#blockSelect').html('');
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







</script>

@endsection
