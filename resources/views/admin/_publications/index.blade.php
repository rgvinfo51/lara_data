@extends('admin.layouts.app')
@section('title', 'Publications')

@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Publications</h4>

				<div class="page-title-right">
				@can('publication_create')
					<a class="btn btn-success" href="{{ route('admin.publications.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Publications</a>
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
					 <table class="table table-bordered" id="example">
					 <thead>
						 <tr>
						   <th>No</th>
						   <th>Category </th>
						   <th>State</th>
						   <th>District</th>
						   <th>Block</th>
						   <th>Year of Issue</th>
						   <th>Title</th>
						   <th>Number of Authors</th>
						   <th>Name of Authors</th>
						   <th>Keywords</th>
						 	<th>Description</th>
						   <th>Thumbnail</th>
						   <th>File</th>
						   <th>Status</th>
						   <th>Action</th>
						 </tr>
						  </thead>
						 <tbody>
						 @if(!$data->isEmpty())
							 @foreach ($data as $key => $order)
							  <tr>
								<td>{{ ++$i }}</td>

								<td>{{ $order->category->name }}</td>
								<td>@foreach( explode(',',$order->state_id) as $state) {{ getLocalityByID($state)->state_name.',' }} @endforeach</td>
								<td>@foreach( explode(',',$order->district) as $district) {{ getDistrictID($district)->district_name.',' }} @endforeach</td>
								<td>@foreach( explode(',',$order->block) as $block) {{ getBlockByID($block)->block_name.',' }} @endforeach</td>
								<td>{{ $order->year_of_issue }}</td>
								<td>{{ $order->title }}</td>
								<td>{{ $order->number_of_authors }}</td>
								<td>{{ $order->name_of_authors }}</td>
								<td>{{ $order->keywords }}</td>
								<td>{{ substr($order->description, 0, 20) }}</td>

								<td>
									<a target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $order->thumbnail }}">View Document</a>
								</td>
								  <td>
									<a target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $order->file }}">View Document</a>
								</td>
								<td>
								@if($order->status == 1)
									<span class="badge badge-soft-success">Approved</span>
								@else
									<span class="badge badge-soft-danger">Not Approved</span>
								@endif


								</td>
							<td>

								  <!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.users.show',$order->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->

                                  @can('publication_edit')
									<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.publications.edit',$order->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>

                                    @endcan
								@can('publication_delete')
								{!! Form::open(['method' => 'DELETE','route' => ['admin.publications.destroy', $order->id],'style'=>'display:inline']) !!}
										{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
									{!! Form::close() !!}
								@endcan



								</td>
							  </tr>
							 @endforeach
							 @else
								<tr>
								 <td colspan="15">No records found!!</td>
							  </tr>
							 @endif
							 </tbody>
							</table>
							 </div>
							{{ $data->render() }}
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
</div>
 <script>
     $(document).ready(function () {
         $('#example').DataTable({
			 paging: false,
			 info: false,
		 });
     });
 </script>
@endsection
