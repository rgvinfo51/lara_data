@extends('admin.layouts.app')
@section('title', 'All Letter/Order')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Letter/Order</h4>

				<div class="page-title-right">
				@can('letter_order_add')				 
					<a class="btn btn-success" href="{{ route('admin.letter-order.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Letter/Order</a>
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
					 <table id="example" class="table table-bordered">
					 <thead>
						 <tr>
						   <th>Sr. No</th>
						   
						   <th>Category </th>
						   <th>Date</th>
						   <th>Keywords</th>
						   <th>Uploaded Doc</th>
						    
						   <th>Action</th>
						 </tr>
						  </thead>
						 <tbody>
						 @if(!$data->isEmpty())
							 @foreach ($data as $key => $order)
							  <tr>
								<td>{{ ++$i }}</td>
								 
								<td>{{ ($order->category->name) ?? '' }}</td>
								<td>{{ $order->order_date }}</td>
								<td>{{ $order->keywords }}</td>
								<td>
									<a target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $order->upload_doc }}">View Document</a> 
								</td>
								 
								 
							<td>
								   
								  <!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.users.show',$order->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
								
								@can('letter_order_edit')								 
									<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.letter-order.edit',$order->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>
								@endcan
								
								@can('letter_order_delete')									{!! Form::open(['method' => 'DELETE','route' => ['admin.letter-order.destroy', $order->id],'style'=>'display:inline']) !!}
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
 