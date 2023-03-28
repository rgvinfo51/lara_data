@extends('admin.layouts.app')
@section('title', 'Edit Agent')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Agent</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.admin-agents.index') }}">User</a></li>
						<li class="breadcrumb-item active">Edit Agent</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	@can('user_edit')
	{!! Form::open(array('route' => ['admin.admin-agents.update', $user->id],'method'=>'PATCH','id' => 'userFrm','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">Agent Detail  </h4>

			</div>

			<div class="card-body">
				<div class="live-preview">
					 
					<div class="row gy-4">
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="name" class="form-label">{{ __('Name') }} *</label>
								<input type="text" name="name" class="form-control" id="name" value="{{ $user->name ?? '' }}" required autocomplete="off">
							</div>
						</div>
						 <!--end col-->
 

						 
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="userStatus" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('userStatus',$user->is_active) == '0') ? 'selected': ''}} value="0">Active</option>
									<option {{(old('userStatus',$user->is_active) == '1') ? 'selected': ''}} value="1">Inactive</option>
								</select>
							</div>
						</div>
						 
					</div>
				</div>
			</div>
		</div>
	</div>
	@can('user_edit')
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
	</div>
	@endcan
</div>

@can('user_edit')
{!! Form::close() !!}

@endcan



</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('public/backend/js/sha.js') }}"></script>
<script>
@php $salt = rand('1000','9999');
session(['salt' => $salt]);
@endphp
 $(document).on('submit','#userFrm',function(){


		var salt = '{{ $salt }}';
		var secret = $('#passwordinput').val();
		var shaObj = new jsSHA("SHA-256", "TEXT");
		shaObj.update(secret);
		var hashPass = shaObj.getHash("HEX");
		$('#password-input').val(hashPass);

	    /* var salt = '{{ $salt }}';
		var secret = $('#passwordinput').val();
		var shaObj = new jsSHA("SHA-256", "TEXT");
	    shaObj.update(secret);
	    var hashPass = shaObj.getHash("HEX");
		var shaObj1 = new jsSHA("SHA-256", "TEXT");
		shaObj1.update(hashPass+salt);
		var hashSalt = shaObj1.getHash("HEX");
		$('#password-input').val(hashSalt); */
});





</script>

@endsection
