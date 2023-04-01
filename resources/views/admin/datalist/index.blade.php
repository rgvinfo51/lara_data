@extends('admin.layouts.app')
@section('title', 'All Data')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Data Management</h4>

				<div class="page-title-right">
				 @can('plan_create')
					<a class="btn btn-success" href="{{ route('admin.datalist.create') }}"> <i class="ri-add-line align-bottom me-1"></i>New Data</a>
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
						 <th> ID</th>
						<th>NAME</th>
						<th>DESIGNATION</th>
						<th>MOBILE NO</th>
						<th>COMPANY NAME</th>
						<th>WEBSITE</th>
						<th>ADDRESS</th>
						<th>OFFICE CONTACT</th>
						<th>EMAIL</th>
						<th>LINKEDIN</th>
						<th>TWITTER</th>
						<th>SKYPE</th>
						<th>QRCODE</th>
						<th>IMAGE1</th>
						<th>IMAGE2</th>
						<th>IMAGE3</th>
						<th>ACTION</th>
					  </tr>
					    </thead>
						 <tbody>
						@foreach ($list as $key => $value)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->designation }}</td>
							<td>{{ $value->mobile_no }}</td>
							<td>{{ $value->company_name }}</td>
							<td>{{ $value->website }}</td>
							<td>{{ $value->address }}</td>
							<td>{{ $value->office_contact }}</td>
							<td>{{ $value->email }}</td>
							<td>{{ $value->linkedin }}</td>
							<td>{{ $value->twitter }}</td>
							<td>{{ $value->skype }}</td>
							<td>{{ $value->qrcode }}</td>
							<td><a target="blank"  href="{{ asset('public/admin/data_image/'.$value->create_image1) }}">Image1</a></td>
							<td><a target="blank"  href="{{ asset('public/admin/data_image/'.$value->create_image2) }}">Image2</a></td>
							<td><a target="blank"  href="{{ asset('public/admin/data_image/'.$value->create_image3) }}">Image3</a></td>
							 
							<td>
								@can('datalist_edit')
									 <a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.datalist.edit',$value->id) }}"><i class="ri-pencil-fill align-bottom"></i></a> 
								@endcan
								@can('datalist_delete')								
								 	{!! Form::open(['method' => 'DELETE','route' => ['admin.datalist.destroy', $value->id],'style'=>'display:inline']) !!}
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
 

 
 