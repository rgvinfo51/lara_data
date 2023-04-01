@extends('admin.layouts.app')
@section('title', 'All Plan')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Plan Management</h4>

				<div class="page-title-right">
				 @can('plan_create')
					<a class="btn btn-success" href="{{ route('admin.plan.create') }}"> <i class="ri-add-line align-bottom me-1"></i>New Plan</a>
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
					 <table id="example" class="table align-middle table-nowrap">
					  <thead>
					  <tr>
						 <th>No</th>
						 <th>Plan Name</th>
						 <th>Plan Duration</th>
						 <th>Total Forms</th>
						 <th>Min Accuracy</th>
						 <th>Rate pr form</th>
						 <th>Status</th>
						 <th>Action</th>
					  </tr>
					    </thead>
						 <tbody>
						@foreach ($list as $key => $value)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $value->plan_name }}</td>
							<td>{{ $value->plan_duration }}</td>
							<td>{{ $value->plan_total_forms }}</td>
							<td>{{ $value->plan_min_accuracy }}</td>
							<td>{{ $value->plan_rate_per_form }}</td>
							<td>
								@if($value->status == 0) 
									<span class="badge badge-soft-success">Active</span>
								@else
									<span class="badge badge-soft-danger">Inactive</span>
								@endif
								</td>
							<td>
								@can('plan_edit')
									 <a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.plan.edit',$value->id) }}"><i class="ri-pencil-fill align-bottom"></i></a> 
								@endcan
								@can('plan_delete')								
								 	{!! Form::open(['method' => 'DELETE','route' => ['admin.plan.destroy', $value->id],'style'=>'display:inline']) !!}
										{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
									{!! Form::close() !!}  
								@endcan
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					</div>

					{!! $list->render() !!}
						 
					</div>
					 
				</div>
			</div>
		</div>
	</div>
		
</div>
</div>
 
@endsection

@section('script')
 <script>
     $(document).ready(function () {
         $('#example').DataTable({
			 paging: false,
			 info: false,
		 });
     });
 </script>
@endsection
 

 
 