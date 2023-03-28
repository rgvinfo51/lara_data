@extends('admin.layouts.app')
@section('title', 'All Notice Board')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Notice Board</h4>

				<div class="page-title-right">
				@can('user_create')				 
					<a class="btn btn-success" href="{{ route('admin.notice-board.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Notice Board</a>
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
						   
						   <th>Message </th>
						   <th>Notice Date</th>
						    
						   <th>Uploaded Doc</th>
						   <th>Status</th>
						   <th>Action</th>
						 </tr>
						  </thead>
						 <tbody>
						 @if(!$data->isEmpty())
							 @foreach ($data as $key => $notice)
							  <tr>
								<td>{{ ++$i }}</td>								 
								<td>{{ $notice->message }}</td>
								<td>{{ date('d-m-Y',strtotime($notice->notice_date)) }}</td>								 
								<td>
									<a target="_blank" href="{{ asset('uploads/notice_board')}}/{{ $notice->upload_file }}">View Document</a> 
								</td>								 
								<td>
								@if($notice->status == 1) 
									<span class="badge badge-soft-success">Active</span>
								@else
									<span class="badge badge-soft-danger">Inactive</span>
								@endif							
								
								</td>
							<td>
								   
								  <!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.users.show',$notice->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
								
								 								 
									<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.notice-board.edit',$notice->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>
							 
								
								@can('user-delete')									{!! Form::open(['method' => 'DELETE','route' => ['admin.notice-board.destroy', $notice->id],'style'=>'display:inline']) !!}
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
 