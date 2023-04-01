@extends('admin.layouts.app')
@section('title', 'Show Role')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Show Role</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
						<li class="breadcrumb-item active">Show Role</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			  
			<div class="card-body">
				<div class="live-preview">
				 
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Role Name') }} </label>
								<br>{{ $role->title }}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							 
							<strong>Permission:</strong>
							<br/>
							@if(!empty($rolePermissions))
								@if($role->name == 'Business Account' || $role->name == 'Super Admin')
									@foreach($permissions as $v)
										<label class="label label-success">{{ $v->title }},</label>
										<br>
									@endforeach
								@else   	
									@foreach($rolePermissions as $v)
										<label class="label label-success">{{ $v->title }},</label>
										<br>
									@endforeach
								@endif
							@endif
						 
						</div>
						<!--end col-->
					 
						 
					</div>
					 
					 
				</div>
			</div>
		</div>
	</div>
					 



</div>
</div>		 
@endsection

 




 