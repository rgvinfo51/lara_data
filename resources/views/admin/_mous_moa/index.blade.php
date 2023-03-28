@extends('admin.layouts.app')
@section('title', 'All Users')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Users</h4>

				<div class="page-title-right">
				@can('user_create')				 
					<a class="btn btn-success" href="{{ route('admin.users.create') }}"> <i class="ri-add-line align-bottom me-1"></i> Add New User</a>
				@endcan
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
					<div class="table-responsive">
					 <table class="table table-bordered">
					 <thead>
						 <tr>
						   <th>No</th>
						   
						   <th>Name</th>
						   <th>Email</th>
						   <th>Mobile</th>
						   <th>Designation</th>	
							<th>Ra</th>
							<th>DOR</th>
						   <th>Status</th>
						   <th>Action</th>
						 </tr>
						  </thead>
						 <tbody>
						 @if(!$data->isEmpty())
							 @foreach ($data as $key => $user)
							  <tr>
								<td>{{ ++$i }}</td>
								 
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ ($user->mobile_no == 0) ? '' : $user->mobile_no }}</td>
								<td>
									 {{ $user->designation }}
								</td>
								 
								<td>
									 {{ $user->designation }}
								</td>
								<td>
									 {{ $user->expired_date }}
								</td>
								 
								<td>
								@if($user->status == 1) 
									<span class="badge badge-soft-success">Active</span>
								@else
									<span class="badge badge-soft-danger">Inactive</span>
								@endif
								
								
								</td>
							<td>
								   
								  <!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.users.show',$user->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
								
								@can('user-edit')								 
									<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.users.edit',$user->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>
								@endcan
								
								@can('user-delete')									{!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
										{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
									{!! Form::close() !!}
								@endcan
								   
								   
								   
								</td> 
							  </tr>
							 @endforeach
							 @else
								<tr>
								 <td colspan="9">No records found!!</td>
							  </tr>
							 @endif
							 </tbody>
							</table>
							 </div>
							{!! $data->render() !!}
						 
					</div>
					 
				</div>
			</div>
		</div>
	</div>
		
</div>
</div>
 
@endsection
 