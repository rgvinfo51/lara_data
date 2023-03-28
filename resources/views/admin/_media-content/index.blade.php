@extends('admin.layouts.app')
@section('title', 'Media Content')

@section('content')
<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Media Content</h4>

				<div class="page-title-right">
					@can('media_create')
					    <a class="btn btn-success" href="{{ route('admin.media-content.create') }}"> <i class="ri-add-line align-bottom me-1"></i> New Media Content</a>
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
											<th>Location</th>
											<th>X</th>
											<th>Y</th>
											<th>Publication Date</th>
											<th>Keywords</th>
											<th>Image Caption</th>
											<th>Description</th>
											<th>Type Of File</th>
											<th>Uploaded FIle</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
										@foreach ($data as $key => $order)
										<tr>
											<td>{{ ++$j }}</td>

											<td>{{ $order->category->name }}</td>
											<td>{{ getLocalityByID($order->state_id)->state_name }}</td>
											<td>@foreach( explode(',',$order->district_id) as $district) {{ getDistrictID($district)->district_name.',' }} @endforeach</td>
											<td>
											@if(!empty($order->block))
												@php
												$blockes = explode(',',$order->block);
												@endphp
													@if(count($blockes) > 0)
														@for ($i=0; $i< count($blockes);$i++)
															{{ getBlockByID($blockes[$i])->block_name.','  }}
														@endfor
													@else
														{{ getBlockByID($order->block)->block_name }}
													@endif
												@endif
											</td>
											<td>{{ $order->location }}</td>
											<td>{{ $order->x }}</td>
											<td>{{ $order->y }}</td>
											<td>{{ $order->publication_date }}</td>
											<td>{{ $order->keywords }}</td>
											<td>{{ $order->image_caption }}</td>
											<td>{{ substr($order->description, 0, 20) }}</td>
											<td>@if($order->type_of_file == 1)
												<span class="badge badge-soft-success">Video</span>
												@else
												<span class="badge badge-soft-danger">Image</span>
												@endif
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


                                                @can('media_edit')
												<a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.media-content.edit',$order->id) }}"><i class="ri-pencil-fill align-bottom"></i></a>

                                                @endcan
												@can('media_delete')
												{!! Form::open(['method' => 'DELETE','route' => ['admin.media-content.destroy', $order->id],'style'=>'display:inline']) !!}
												{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
												{!! Form::close() !!}
												@endcan



											</td>
										</tr>
										@endforeach
										@else
										<tr>
											<td colspan="16">No records found!!</td>
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
	$(document).ready(function() {
		$('#example').DataTable({
			 paging: false,
			 info: false,
		 });
	});
</script>
@endsection
