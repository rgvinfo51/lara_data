@extends('business.layouts.app')
@section('title', 'Create User')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Add New User</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('business.users.index') }}">User</a></li>
						<li class="breadcrumb-item active">Add New User</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	{!! Form::open(array('route' => 'business.users.store','method'=>'POST','files' => 'true','enctype'=>'multipart/form-data')) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">User Detail</h4>
				 
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
								<label for="labelcode" class="form-label">{{ __('Organization Code') }} *</label>
								<input type="text"  disabled readonly class="form-control" id="labelcode" value="{{Auth::user()->code}}">
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
								<label for="typeSelect" class="form-label">{{ __('Role') }} *</label>
								<select name="roles" class="form-select" id="roles" required>
									<option value="">Choose...</option>
									@foreach($roles as $role)
										<option {{(old('userType') == 'Super Admin') ? 'selected': ''}} value="{{$role}}">{{$role}}</option>
									@endforeach									 
									 
								</select>
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
								<input type="tel" name="contact_number" maxlength="10" class="form-control numbersonly" value="{{old('contact_number')}}" id="labelMobile" required>
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
if('{{old("district")}}'){
get_state_district('{{old("state") ?? ''}}','{{old("district") ?? ''}}');
}
function get_state_district(that,selected_state='') {
    var state_id = $(that).val();
	
    $.ajax({
        url: "{{ route('business.ajax.district') }}",
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



@endsection
