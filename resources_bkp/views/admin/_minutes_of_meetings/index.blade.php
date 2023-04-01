@extends('admin.layouts.app')
@section('title', 'All Minutes of Meetings')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Minutes of Meetings</h4>

				<div class="page-title-right">
				@can('minutes_of_meetings_add')				 
					<a class="btn btn-success" href="{{ route('admin.minutes-of-meetings.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Minutes of Meetings</a>
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
					 <table  id="example" class="table table-bordered">
					 <thead>
						 <tr>
						   <th>Sr. No</th>						   
						   <th>Category </th>
						   <th>Date</th>
						   <th>Keywords</th>
						   <th>Uploaded Minutes</th>
						   <th>Uploaded final PPT</th>
						    
						   <th>Action</th>
						 </tr>
						  </thead>
						 <tbody>
						 @if(!$data->isEmpty())
							 @foreach ($data as $key => $order)
							  <tr>
								<td>{{ ++$i }}</td>
								 
								<td>{{ ($order->category->name) ?? '' }}</td>
								<td>{{ \Carbon\Carbon::parse($order->meeting_date)->format('d-m-Y') }}</td>
								<td>{{ $order->keywords }}</td>
								<td>
									<a target="_blank" href="{{ asset('public/uploads/MinutesOfMeeting/upload_minutes')}}/{{ $order->upload_minutes }}">View Upload Minutes </a> 
								</td>
								 <td>
									<a target="_blank" href="{{ asset('public/uploads/MinutesOfMeeting/upload_final_ppt')}}/{{ $order->upload_final_ppt }}">View PPT File</a> 
								</td>
								 
							<td>
								   
								  <!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.users.show',$order->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
								
								 @can('minutes_of_meetings_edit')								 
									<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.minutes-of-meetings.edit',$order->id) }}"><i class="ri-eye-fill align-bottom"></i></a>
								@endcan
								
								{{-- @can('minutes_of_meetings_delete')								{!! Form::open(['method' => 'DELETE','route' => ['admin.minutes-of-meetings.destroy', $order->id],'style'=>'display:inline']) !!}
										{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
									{!! Form::close() !!}
								@endcan --}}
								   
								   
								   
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
 