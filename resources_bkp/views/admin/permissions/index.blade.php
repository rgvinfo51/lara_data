@extends('admin.layouts.app')
@section('title', 'All Permissions')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Permission Management</h4>

				<div class="page-title-right">
				 @can('permission-create')
					<a class="btn btn-success" href="{{ route('admin.permissions.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Permission</a>
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
					 <table class="table table-bordered">
						  <tr>
							 <th>No</th>
							 <th>Name</th>
							 <th width="280px">Action</th>
						  </tr>
							@foreach ($permissions as $key => $permission)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $permission->title }}</td>
								<td>
									<!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.permissions.show',$permission->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
									@can('permission-edit')
										<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.permissions.edit',$permission->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>
									@endcan
									@can('permission-delete')
										{!! Form::open(['method' => 'DELETE','route' => ['admin.permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
											{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
										{!! Form::close() !!}
									@endcan
								</td>
							</tr>
							@endforeach
						</table>
							{!! $permissions->render() !!}
						 
					</div>
					 
				</div>
			</div>
		</div>
	</div>
		
</div>
</div>
 
@endsection
 