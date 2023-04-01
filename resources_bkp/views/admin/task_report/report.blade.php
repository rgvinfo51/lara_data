@extends('admin.layouts.app')
@section('title', 'Report Releaselist')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Report Release List</h4>

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
						<table id="submission_report" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>SNo</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
									<th>CUST NAME</th>
									<th>CONTACT No</th>
									<th>EMAIL</th>
									<th>REG DATE</th>
									<th>SUB DATE</th>
									<th>TOTAL</th>
									 <th>CORRECT</th>
									 <th>INCORRECT</th>
									<th>VIEW REPORT</th>
									<th>IS ACTIVE</th>
									<th>RELEASE REPORT</th>
								</tr>
							</thead>
							<tbody>
								<tr>No data Found</tr>
							</tbody>
							<tfoot>
								  <tr>
									<th>SNo</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
									<th>CUST NAME</th>
									<th>CONTACT No</th>
									<th>EMAIL</th>
									<th>REG DATE</th>
									<th>SUB DATE</th>
									<th>TOTAL</th>
									 <th>CORRECT</th>
									 <th>INCORRECT</th>
									<th>VIEW REPORT</th>
									<th>IS ACTIVE</th>
									<th>RELEASE REPORT</th>
									
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

 