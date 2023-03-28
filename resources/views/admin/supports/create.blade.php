@extends('admin.layouts.app')
@section('title', 'Create Support')
 

@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add New Support</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.supports.index') }}">User</a></li>
						<li class="breadcrumb-item active">Add New Support</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('name' => 'userFrm','id' => 'userFrm','route' => 'admin.supports.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">Support Detail </h4>

			</div>

			<div class="card-body">
				<div class="live-preview">
					<input type="hidden" name="user_type" class="form-control" id="user_type" value="3" required>	

					<div class="row gy-4">
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="company_name" class="form-label">{{ __('Name') }} *</label>
								<input type="text" name="company_name" class="form-control" id="company_name" value="{{old('company_name')}}" required autocomplete="off">
							</div>
						</div>
						 <!--end col-->

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="admin_email" class="form-label">{{ __('Email * (Username)') }} </label>
								<div class="form-icon right">
									<input type="email" name="admin_email" class="form-control form-control-icon" value="{{old('admin_email')}}" id="admin_email" required autocomplete="off"><i class="ri-mail-unread-line"></i>
								</div>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelMobile" class="form-label">{{ __('Contact No.') }} *</label>
								<input type="tel" name="contact" maxlength="10" class="form-control numbersonly" value="{{old('contact')}}" id="labelMobile" required autocomplete="off">
							</div>
						</div>
						<!--end col-->
  
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="userStatus" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('userStatus') == '1') ? 'selected': ''}} value="1">Active</option>
									<option {{(old('userStatus') == '0') ? 'selected': ''}} value="0">Inactive</option>
								</select>
							</div>
						</div>
						 
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


</script>
 
@endsection
