@extends('admin.layouts.app')
@section('title', 'All Category')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Category Management</h4>

				<div class="page-title-right">
				 @can('letter_category_add')
					<a class="btn btn-success" href="{{ route('admin.letter-order-category.create') }}"> <i class="ri-add-line align-bottom me-1"></i>New category</a>
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
					 <table  id="example" class="table table-bordered">
					 <thead>
					  <tr>
						 <th>Sr. No</th>
						 <th>Name</th>
						 <th>Parent Name</th>
						 <th>Status</th>
						 <th width="280px">Action</th>
					  </tr>
					  </thead>
					  <tbody>
						@foreach ($data as $key => $category)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ ($category->parent->name) ?? '-' }}</td>
							<td>
								@if($category->status == 1) 
									<span class="badge badge-soft-success">Active</span>
								@else
									<span class="badge badge-soft-danger">Inactive</span>
								@endif
								</td>
							<td>
								<!-- <a class="btn btn-info_ btn-icon waves-effect waves-light" href="{{ route('admin.letter-order-category.show',$category->id) }}"><i class="ri-eye-fill align-bottom "></i></a> -->
								@can('letter_category_edit')
									 <a class="btn btn-primary_ btn-icon waves-effect waves-light" href="{{ route('admin.letter-order-category.edit',$category->id) }}"><i class="ri-pencil-fill align-bottom"></i></a> 
								@endcan
								@can('letter_category_delete')								
								<!--	{!! Form::open(['method' => 'DELETE','route' => ['admin.letter-order-category.destroy', $category->id],'style'=>'display:inline']) !!}
										{!! Form::button('<i class="ri-delete-bin-5-line"></i>', ['type' => 'submit','class' => 'btn btn-danger_ btn-icon waves-effect waves-light']) !!}
									{!! Form::close() !!} -->
								@endcan
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>


					{!! $data->render() !!}
						 
					</div>
					 
				</div>
			</div>
		</div>
	</div>
		
</div>
</div>
 
@endsection