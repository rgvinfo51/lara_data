@extends('admin.layouts.app')
@section('title', 'Create Plan')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add Plan</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.plan.index') }}">Plan</a></li>
						<li class="breadcrumb-item active">Add Plan</li>
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
				{!! Form::open(array('route' => 'admin.plan.store','method'=>'POST')) !!}
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Plan Name') }} *</label>
								{!! Form::text('plan_name', null, array('placeholder' => 'Plan Name','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelDuration" class="form-label">{{ __('Plan Duration') }} *</label>
								{!! Form::number('plan_duration', null, array('placeholder' => 'Plan Duration','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labeltotal_forms" class="form-label">{{ __('Plan Total Forms') }} *</label>
								{!! Form::number('plan_total_forms', null, array('placeholder' => 'Plan Total Forms','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelmin_accuracy" class="form-label">{{ __('Plan Min Accuracy') }} *</label>
								{!! Form::number('plan_min_accuracy', null, array('placeholder' => 'Plan Min Accuracy','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelrate_per_form" class="form-label">{{ __('Plan rate per form') }} *</label>
								{!! Form::number('plan_rate_per_form', null, array('placeholder' => 'Plan rate per form','class' => 'form-control','required' => 'required')) !!}
							</div>
						</div>
						<!--end col-->
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status') == '0') ? 'selected': ''}} value="0">Active</option>
									<option {{(old('status') == '1') ? 'selected': ''}} value="1">Inactive</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						 
						 <div class="col-xxl-3 col-md-6">
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