@extends('admin.layouts.app')
@section('title', 'Create Role')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add Role</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
						<li class="breadcrumb-item active">Add Role</li>
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
				{!! Form::open(array('route' => 'admin.roles.store','method'=>'POST')) !!}
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Name') }} *</label>
								{!! Form::text('title', null, array('placeholder' => 'Name','class' => 'form-control','autocomplete="off"')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							 
							<strong>Permission:</strong>
							<br/>
							@foreach($permission as $value)
								<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
								{{ $value->title }}</label>
							<br/>
							@endforeach
						 
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