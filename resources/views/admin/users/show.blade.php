@extends('business.layouts.app')
@section('title', 'Create User')
 @section('style')
 
@endsection
@section('content')


<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add New Organization</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="javascript: void(0);">Organization</a></li>
						<li class="breadcrumb-item active">Add New Organization</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('route' => 'admin.organizations.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">Organization Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Name') }} *</label>
								<input type="text" name="userName" class="form-control" id="labelName" value="{{old('userName')}}" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Code') }} *</label>
								<input type="text" name="userCode" class="form-control" id="labelcode" value="{{old('userCode')}}" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelEmail" class="form-label">{{ __('Email * (Username)') }} </label>
								<div class="form-icon right">
									<input type="email" name="userEmail" class="form-control form-control-icon" value="{{old('userEmail')}}" id="labelEmail" required><i class="ri-mail-unread-line"></i>
								</div>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelAddress" class="form-label">{{ __('Address') }} </label>
								<textarea name="address" class="form-control" id="labelAddress" rows="2">{{old('address')}}</textarea>
								 
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelstate" class="form-label">{{ __('State*') }} </label>
								<select name="state" class="form-select" id="labelstate" onchange="get_state_district(this,'{{old('state')}}')">
									<option value="">Select State...</option>
									@foreach($states as $state)
									<option {{(old('state') == $state->id) ? 'selected' : ''}} value="{{$state->id}}">{{$state->state_name}}</option>
									@endforeach									 
								</select>								 
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labeldistrcit" class="form-label">{{ __('District*') }} </label>
								<select name="district" class="form-select" id="labeldistrcit">
									<option selected="">Select District...</option>
									 									 
								</select>
								 
							</div>
						</div>
						<!--end col-->						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="typeSelect" class="form-label">{{ __('Type') }} *</label>
								<select name="userType" class="form-select" id="typeSelect" required>
									<option value="">Choose...</option>
									<option {{(old('userType') == 'superadmin') ? 'selected': ''}} value="superadmin">Superadmin</option>
									<option {{(old('userType') == 'business') ? 'selected': ''}} value="business">Business</option>
									 
								</select>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="contact_name" class="form-label">{{ __('Contact Person Name*') }} *</label>
								<input type="text" name="contact_name" class="form-control" id="contact_name" value="{{old('contact_name')}}" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="designation" class="form-label">{{ __('Designation*') }} </label>								 
									<input type="text" name="designation" class="form-control form-control-icon" value="{{old('designation')}}" id="designation" required> 								 
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelMobile" class="form-label">{{ __('Contact No.') }} *</label>
								<input type="tel" name="contact_no" maxlength="10" class="form-control numbersonly" value="{{old('contact_no')}}" id="labelMobile" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="nodelEmail" class="form-label">{{ __('Email Address*') }} </label>
								<div class="form-icon right">
									<input type="email" name="contact_email" class="form-control form-control-icon" value="{{old('contact_email')}}" id="nodelEmail" required><i class="ri-mail-unread-line"></i>
								</div>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="userStatus" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('userStatus') == '1') ? 'selected': ''}} value="1">Active</option>
									<option {{(old('userStatus') == '2') ? 'selected': ''}} value="2">Inactive</option>									 
								</select>
							</div>
						</div>
						<div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Logo (png,jpeg,gif)</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
										<div id="dropzone" class="dropzone" style="width: 200px;"></div>
                                    <div class="hidden_images_logo"><input type="hidden" name="logo_hidden_images[]" value="{{ isset($data->file_path)?$data->file_path:'' }}"/>
                                    </div>
										
                                         <!--   <div class="dropzone" style="padding: 0;min-height: 150px;">
                                            <div class="avatar-xl mx-auto">
                                                <input type="file" class="filepond filepond-input-circle" required name="logo-upload" id="logoupload" accept="image/png, image/jpeg, image/gif" />
                                            </div>
											<ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded">
                                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Dropzone-Image" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="pt-1">
                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-3">
                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
											</div> -->
											
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div> <!-- end col -->
								
								  
								
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-4 flex-grow-1">Module Permission*</h4>				 
			</div>			
			<div class="card-body">
				<div class="live-preview">				  
					<div class="row gy-4">					 
					 @foreach($application_modules as $application_module)
						<div class="col-xxl-3 col-md-3 mt-0">
							<div class="form-check form-check-secondary mb-2">
                             <input class="form-check-input" name="assign_module[]"  type="checkbox" id="formCheck{{$application_module->id}}" value="{{$application_module->id}}" >
                             <label class="form-check-label" for="formCheck{{$application_module->id}}">
							 {{$application_module->module_name}}
                              </label>
                            </div>				
							
						</div>
						@endforeach
						<!--end col-->			 
						 					 
					</div>
				 
				</div>
			</div>
		</div>
	</div>
</div>



<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Package</h4>				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
					<div class="row gy-4">
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('User Limit') }} *</label>
								<select name="numberOfUsers" class="form-select" id="labelNumberOfUsers" >
									<option value="">Select Limit...</option>
									@for($i=10;$i<=100;$i+=10)
									<option {{(old('numberOfUsers') == $i) ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
									@endfor									 
								</select>
								 
							</div>
						</div>
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelUserValidity" class="form-label">{{ __('Valid till') }} *</label>
								<input type="date" name="userValidity" min="{{date('Y-m-d')}}" class="form-control" value="{{old('userValidity')}}" id="labelUserValidity" required>
							</div>
						</div>
						 
						<!--end col-->			 
					 				 
					</div>
					
					
					 
				</div>
			</div>
		</div>
	</div>
</div>

  
<div class="row mt-2">
	<div class="col-lg-12">
		 
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">	
						<h4 class="card-title mb-0 flex-grow-1">Upload Document*</h4>
					</div><!-- end card header -->
					<div class="card-body">	
						<div id="dropzone_doc" class="dropzone" style="width: 100%;"></div>
                                    <div class="hidden_images_area">
									 
                                    </div>
						 
					</div>
					<!-- end card body -->
				</div>
				<!-- end card -->
			</div> <!-- end col -->

			 
		</div>
		<!-- end row -->
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
						</div>
	<!-- end col -->
</div>

{!! Form::close() !!}



</div> 
@endsection
@section('script')
<script>
function get_state_district(that,selected_state='') {
    var state_id = $(that).val();
	
    $.ajax({
        url: "{{ route('admin.ajax.district') }}",
        method: "POST",
        dataType: 'json',
        data: {
            'state': state_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            $('#labeldistrcit').html('');
            var option ='';
			var selected = '';
            option +='<option value="">Select District</option>';  
            $.each(result.data, function(i, item) {
				if(selected_state != '')
				{
					if(selected_state == item.id)
					{
						 selected = 'selected';
					}else{
						selected = '';
					}
				}
				option +="<option "+selected+" value='"+item.id+"'>"+item.district_name+"</option>";
               
            });
			 
			 $('#labeldistrcit').html(option);
        }
    });
}

 

</script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script>

// Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", { 
        url: "{{route('admin.organization.storeMedia')}}",
        paramName: "file",
        maxFilesize: 2,
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
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
                    var hiddenImage = $('<input type="hidden" name="logo_hidden_images" value="' + response.name + '"/>');
                    $('.hidden_images_logo').html(hiddenImage);
                })
            }
    });
	
	const dropzone1 = new Dropzone("#dropzone_doc", { 
        url: "{{route('admin.organization.storeDocMedia')}}",
        paramName: "file",
        maxFilesize: 2,
        maxFiles: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
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
                    var hiddenImage = $('<input type="hidden" name="doc_hidden_images[]" value="' + response.name + '"/>');
                    $('.hidden_images_area').append(hiddenImage);
                })
            }
    });
	
	 


 

</script>


@endsection
