@extends('admin.layouts.app')
@section('title', 'Edit Category')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Category</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.letter-order-category.index') }}">Categories</a></li>
						<li class="breadcrumb-item active">Edit Category</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			 @if (count($errors) > 0)
			  <div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
				   @foreach ($errors->all() as $error)
					 <li>{{ $error }}</li>
				   @endforeach
				</ul>
			  </div>
			@endif
			<div class="card-body">
				<div class="live-preview">
				@can('letter_category_edit')
				{!! Form::model($category, ['method' => 'PATCH','route' => ['admin.letter-order-category.update', $category->id]]) !!}
				@endcan
					<div class="row gy-4">
					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Name') }} *</label>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','maxlength' => '255', 'required')) !!}
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="categorySelect" class="form-label">{{ __('Parent Category') }}*</label>
								<select name="parent_id" class="form-select" id="categorySelect" required>
									<option value="">{{ __('Choose...') }}</option>
									 
									@foreach($categories as $cat)
									<option {{(old('parent_id',$cat->id) == $category->parent_id) ? 'selected': ''}} value="{{$cat->id}}">{{$cat->name}}</option>
									@include('admin.letter_category.subcategories', ['cat' => $cat,'count' =>''])
									@endforeach
									 								 
								</select>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status',$category->status) == '1') ? 'selected': ''}} value="1">Active</option>
									<option {{(old('status',$category->status) == '0') ? 'selected': ''}} value="0">Inactive</option>									 
								</select>
							</div>
						</div>
						<!--end col-->
						 @can('letter_category_edit')
						 <div class="col-xxl-3 col-md-6">
							<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
						</div>
						@endcan
						 
						<!--end col-->
						 
					</div>
					@can('letter_category_edit')
					{!! Form::close() !!}
					@endcan
					 
				</div>
			</div>
		</div>
	</div>
					 



</div>
</div>		 
@endsection

 