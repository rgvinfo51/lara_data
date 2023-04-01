@extends('admin.layouts.app')
@section('title', 'Create Data')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add Data</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Data</a></li>
						<li class="breadcrumb-item active">Add Data</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
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
			<div class="card-body">
				<div class="live-preview">
				{!! Form::open(array('route' => 'admin.datalist.store','method'=>'POST')) !!}
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Name') }} *</label>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelDuration" class="form-label">{{ __('Designation') }} *</label>
								{!! Form::number('designation', null, array('placeholder' => 'Plan Duration','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labeltotal_forms" class="form-label">{{ __('Mobile No') }} *</label>
								{!! Form::number('mobile_no', null, array('placeholder' => 'Mobile No','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelmin_accuracy" class="form-label">{{ __('Company Name') }} *</label>
								{!! Form::number('company_name', null, array('placeholder' => 'Company Name','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelrate_per_form" class="form-label">{{ __('Website') }} *</label>
								{!! Form::number('website', null, array('placeholder' => 'Website','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelrate_per_form" class="form-label">{{ __('Address') }} *</label>
								{!! Form::number('address', null, array('placeholder' => 'Address','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelrate_per_form" class="form-label">{{ __('Office Contact') }} *</label>
								{!! Form::number('office_contact', null, array('placeholder' => 'Office Contact','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						 <div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelrate_per_form" class="form-label">{{ __('Email') }} *</label>
								{!! Form::number('email', null, array('placeholder' => 'Email','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Linkedin') }}*</label>
								<select name="linkedin" class="form-select" id="linkedinSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('linkedin') == 'Yes') ? 'selected': ''}} value="Yes">Yes</option>
									<option {{(old('linkedin') == 'No') ? 'selected': ''}} value="No">No</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="twitterSelect" class="form-label">{{ __('Twitter') }}*</label>
								<select name="twitter" class="form-select" id="twitterSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('twitter') == 'Yes') ? 'selected': ''}} value="Yes">Yes</option>
									<option {{(old('twitter') == 'No') ? 'selected': ''}} value="No">No</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						 
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="skypeSelect" class="form-label">{{ __('Skype') }}*</label>
								<select name="skype" class="form-select" id="skypeSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('skype') == 'Yes') ? 'selected': ''}} value="Yes">Yes</option>
									<option {{(old('skype') == 'No') ? 'selected': ''}} value="No">No</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="qrcodeSelect" class="form-label">{{ __('Qrcode') }}*</label>
								<select name="qrcode" class="form-select" id="qrcodeSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('qrcode') == 'Yes') ? 'selected': ''}} value="Yes">Yes</option>
									<option {{(old('qrcode') == 'No') ? 'selected': ''}} value="No">No</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						 
						 <div class="col-xxl-3 col-md-6 pt-4">
							<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
						</div>						 
						<!--end col-->
						 
					</div>
					{!! Form::close() !!}
					 
				</div>
			</div>
		</div>
	</div>
					 



</div>
</div>	
	 
@endsection