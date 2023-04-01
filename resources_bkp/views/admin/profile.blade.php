@extends('admin.layouts.app')

@section('content')

<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12">
	<div class="p-3 py-5">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h4 class="text-right">Profile</h4>
		</div>
		<div class="row mt-2">
			<div class="col-md-4"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="Ajay" value="{{Auth::guard('misadmin')->user()->first_name}}" disabled=""></div>
			<div class="col-md-4"><label class="labels">Middle Name</label><input type="text" class="form-control" value="{{Auth::guard('misadmin')->user()->middle_name}}" placeholder="Kumar" disabled=""></div>
			<div class="col-md-4"><label class="labels">Last Name</label><input type="text" class="form-control" value="{{Auth::guard('misadmin')->user()->first_name}}" placeholder="Pal" disabled=""></div>
		</div>
		<div class="row mt-3">

			<div class="col-md-4"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="ajay@gmail.com" value="{{Auth::guard('misadmin')->user()->email}}" disabled=""></div>
			<div class="col-md-4"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="9999012346" value="{{Auth::guard('misadmin')->user()->mobile_no}}" disabled=""></div>
			<div class="col-md-4"><label class="labels">User Name</label><input type="text" class="form-control" placeholder="username" value="{{Auth::guard('misadmin')->user()->user_name}}" disabled=""></div>

		</div>





		{{--<div class="mt-5 text-center"><a class="next" type="button">Save Profile</a></div>--}}
	</div>
	</div>
	</div>


@endsection
@push('script')


@endpush

