@extends('admin.layouts.app')
@section('title', 'Edit Letter/Order')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Letter/Order</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.letter-order.index') }}">Letter/Order</a></li>
						<li class="breadcrumb-item active">Edit Letter/Order</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
@can('letter_order_edit')	 
 {!! Form::model($order, ['method' => 'PATCH','route' => ['admin.letter-order.update', $order->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
 @endcan
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
				<h4 class="card-title mb-0 flex-grow-1">Letter/Order Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">	
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Category') }} *</label>
								<select name="category_id" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($categories as $category)
										<option  {{(old('category_id',$order->cat_id) == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
										@include('admin.letter_order.subcategories', ['cat' => $category,'count' =>''])
									@endforeach									 
									 
								</select>
							</div>
						</div>
						 
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Date') }} *</label>
								<input type="date" name="order_date" class="form-control" id="labelName" value="{{old('order_date',$order->order_date)}}" required>
							</div>
						</div>
						 <!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" class="form-control" id="labelcode" value="{{old('keywords',$order->keywords)}}">
							</div>
						</div>
						<!--end col-->
					 
												
						
						@can('approval_access') 
						{{-- <div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Approval Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status',$order->status) == '1') ? 'selected': ''}} value="1">Approve</option>
									<option {{(old('status',$order->status) == '0') ? 'selected': ''}} value="0">Not Approved</option>									 
								</select>
							</div>
						</div> --}}
						<input type="hidden" name="status" value="1">
						@else
							<input type="hidden" name="status" value="{{$order->status}}">
						@endcan
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload Doc (pdf)') }} </label>
								<div id="dropzone" class="dropzone" >
								 
								</div>
                                    <div class="hidden_images_logo">
									<input type="hidden" name="logo_hidden_images" value="{{ old('logo_hidden_images',$order->upload_doc) }}"/>
                                    </div>
								@if(!empty($order->upload_doc))
										<a href="{{asset('uploads/documents/'.$order->upload_doc)}}" target="_BLANK" class="btn btn-primary"> View Doc</a>
									@endif; 
							</div>
						</div>
						 
						<!--end col-->
						 	  
								
					</div>
				</div>
			</div>
		</div>
	</div>
	@can('letter_order_edit')
		@can('approval_access')
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
			</div>
		 @else
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Update  for Approval') }}</button>
			</div>
		@endcan
	@endcan
</div>
  
@can('letter_order_edit')
{!! Form::close() !!}
@endcan


</div> 
@endsection
@section('script')
<script>
 // Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", { 
        url: "{{route('admin.letter-order.storeMedia')}}",
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
