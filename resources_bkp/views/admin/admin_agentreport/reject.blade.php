@extends('admin.layouts.app')
@section('title', ' Agent Reject list')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Agent Report Reject List</h4>

				<div class="page-title-right"> 
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
						<table id="user_list" class="display table table-bordered" width="100%" cellspacing="0">
							<thead>

								<tr>
									<th>ID</th>
									<th>DATE</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
									<th>COMP NAME</th>
								    <th>AGENT NAME</th> 
									<th>NAME</th> 
									<th>EMAIL</th>
									<th>Mobile</th>
									<th>ALT MOBILE</th>
									<th>ADDRESS</th>
									<th>CITY</th>
									<th>STATE</th>
									<th>PINCODE</th>
									<th>DOC1</th>
									<th>DOC2</th>                                            
									<th>PHOTO</th>
									<th>AGREEMENT</th>                                             
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							{{-- <tbody>
								@if(!$data->isEmpty())
									@foreach ($data as $key => $user)
									 <tr>
									   <td>{{ $loop->iteration }} </td>	
									   <td>{{ $user->user_reg_date }} </td> 
									   <td>{{ $user->username }} </td>
									   <td>{{ $user->password }} </td>
									   <td> </td>
									   <td> </td>
									   <td>{{ $user->customer_name }} </td>
									   <td>   </td>
									   <td>{{ $user->customer_mobile  }} </td>
									   <td>{{ $user->customer_altmobile }} </td>
									   <td>{{ $user->customer_locality }} </td>
									   <td>{{ $user->your_city }} </td>
									   <td>{{ $user->your_state }} </td>
									   <td>{{ $user->customer_pincode }} </td>
									 </tr>
									@endforeach
									@else
									   <tr>
										<td colspan="9">No records found!!</td>
									 </tr>
									@endif
									</tbody> --}}
									<tfoot>
										<tr>
											<th>ID</th>
											<th>DATE</th>
											<th>USERNAME</th>
											<th>PASSWORD</th>
											<th>COMP NAME</th>
											<th >AGENT NAME</th>  
											<th>NAME</th>  
											<th>EMAIL</th>
											<th>Mobile</th>
											<th>ALT MOBILE</th>
											<th>ADDRESS</th>
											<th>CITY</th>
											<th>STATE</th>
											<th>PINCODE</th>
											<th>DOC1</th>
											<th>DOC2</th>                                            
											<th>PHOTO</th>
											<th>AGREEMENT</th>                                             
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</tfoot>
						</table>
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

 