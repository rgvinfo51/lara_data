@extends('admin.layouts.app')
@section('title', 'Create Category')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add Category</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.mom-category.index') }}">Categories</a></li>
						<li class="breadcrumb-item active">Add Category</li>
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
				@can('mom_category_add')
				{!! Form::open(array('route' => 'admin.mom-category.store','method'=>'POST')) !!}
				@endcan
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Name') }} *</label>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','maxlength' => '255', 'required')) !!}
							</div>
						</div>
						<!--end col-->
						 
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
						 @can('mom_category_add')
						 <div class="col-xxl-3 col-md-6">
							<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
						</div>
						@endcan
						 
						<!--end col-->
						 
					</div>
					@can('mom_category_add')
					{!! Form::close() !!}
					@endcan
					 
				</div>
			</div>
		</div>
	</div>
					 



</div>
</div>	
	 
@endsection