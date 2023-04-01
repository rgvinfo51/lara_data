@extends('admin.layouts.app')
@section('title', 'Create Notice board')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">New Notice board</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.notice-board.index') }}">Notice board</a></li>
						<li class="breadcrumb-item active">New Notice board</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('route' => 'admin.notice-board.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">Notice Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">	
						 
						 
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Notice Date') }} *</label>
								<input type="date" name="notice_date" class="form-control" id="labelName" value="{{old('notice_date')}}" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status') == '1') ? 'selected': ''}} value="1">Active</option>
									<option {{(old('status') == '0') ? 'selected': ''}} value="0">Inactive</option>									 
								</select>
							</div>
						</div>
						 <!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Notice Text') }} *</label>
								 
								<textarea name="notice_text" class="form-control">{{old('notice_text')}}</textarea>
							</div>
						</div>
						<!--end col-->
					 
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload Doc (if any) (pdf)') }} </label>
								<div id="dropzone" class="dropzone" >
								 
								</div>
                                    <div class="hidden_images_logo"><input type="hidden" name="logo_hidden_images" value="{{ old('logo_hidden_images') }}"/>
                                    </div>
								 
							</div>
						</div>
						 
						<!--end col-->
						 	  
								
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
	</div>
</div>
  

{!! Form::close() !!}



</div> 
@endsection
@section('script')
<script>
 // Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", { 
        url: "{{route('admin.notice-board.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
        acceptedFiles: ".pdf",
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

</script>



@endsection
