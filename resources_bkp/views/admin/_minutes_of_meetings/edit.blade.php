@extends('admin.layouts.app')
@section('title', 'Edit Minutes of Meetings')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Minutes of Meetings</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.minutes-of-meetings.index') }}">Minutes of Meetings</a></li>
						<li class="breadcrumb-item active">Edit Minutes of Meetings</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
{{--@can('minutes_of_meetings_edit')	 
 {!! Form::model($mom, ['method' => 'PATCH','route' => ['admin.minutes-of-meetings.update', $mom->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
@endcan --}}
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
			
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Minutes of Meetings Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">	
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Category') }} *</label>
								<select name="cat_id" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($categories as $category)
										<option  {{(old('cat_id',$mom->cat_id) == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
									@endforeach									 
									 
								</select>
							</div>
						</div>
						 
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Meeting Date') }} *</label>
								<input type="date" name="meeting_date" class="form-control" id="labelName" value="{{old('meeting_date',$mom->meeting_date)}}" required>
							</div>
						</div>
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Chaired By') }} *</label>
								<select name="chaired_by" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($users as $user)
										<option  {{(old('chaired_by',$mom->chaired_by) == $user->id) ? 'selected': ''}} value="{{$user->id}}">{{$user->name}}</option>
									@endforeach									 
									 
								</select>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Meeting Place') }} *</label>
								<input type="text" name="meeting_place" class="form-control" id="labelcode" value="{{old('meeting_place',$mom->meeting_place)}}" required>
							</div>
						</div>
						 <!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" class="form-control" id="labelcode" value="{{old('keywords',$mom->keywords)}}" required>
							</div>
						</div>
						<!--end col-->
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelcode" class="form-label">{{ __('Meeting Topic') }} *</label>
								<input type="text" name="meeting_topic" class="form-control" id="labelcode" value="{{old('meeting_topic',$mom->meeting_topic)}}" required>
							</div>
						</div>
						<!--end col-->
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload Minutes') }} *</label>
								<div id="dropzone" class="dropzone" >
								 
								</div>
                                    <div class="upload_minutes_file">
									<input type="hidden" name="upload_minutes_file" value="{{ old('upload_minutes_file',$mom->upload_minutes) }}"/>
									 
                                    </div>
								@if(!empty($mom->upload_minutes))
										<a href="{{asset('uploads/MinutesOfMeeting/upload_minutes/'.$mom->upload_minutes)}}" target="_BLANK" class="btn btn-primary"> View Doc</a>
									@endif
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelNumberOfUsers" class="form-label">{{ __('Upload final ppt (ppt)') }} *</label>
								<div id="dropzone1" class="dropzone" >
								 
								</div>
                                    <div class="upload_final_ppt_file"><input type="hidden" name="upload_final_ppt_file" value="{{ old('upload_final_ppt_file',$mom->upload_final_ppt) }}"/>
                                    </div>
								 @if(!empty($mom->upload_final_ppt))
										<a href="{{asset('uploads/MinutesOfMeeting/upload_final_ppt/'.$mom->upload_final_ppt)}}" target="_BLANK" class="btn btn-primary"> View ppt Doc</a>
									@endif;
							</div>
						</div>
						 
						<!--end col-->
						@can('approval_access') 
						{{-- <div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Approval Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('status',$mom->status) == '1') ? 'selected': ''}} value="1">Approve</option>
									<option {{(old('status',$mom->status) == '0') ? 'selected': ''}} value="0">Not Approved</option>									 
								</select>
							</div>
						</div> --}}
						<input class="form-select" type="hidden" name="status" value="1">
						@else
							<input type="hidden" name="status" value="{{$mom->status}}">
						@endcan
						 	  
								
					</div>
				</div>
			</div>
		</div>
		
		<div class="card">			 
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Agenda</h4>				 
			</div>			
			<div class="card-body">
				<div class="live-preview">			
				 	<div class="row gy-4">			 
					   
						 
						<div class="col-md-12" id="attributes_agenda">
						@forelse($mom->momAgendaDetail as $value)
						  <div class="col-md-12 attr" style="float: left;">
									<div class="col-md-3" style="float: left; padding: 5px;">
										<label for="labelName" class="form-label">{{ __('Agenda Name')}} *</label>
										<input type="text" class="form-control p_org_1" id="agenda_0" name="agenda[agenda_name][0]" value="{{$value->agenda_name}}" required maxlength="255">
									</div>
									<div class="col-md-3" style="float: left; padding: 5px;">
										<label for="byWhomeSelect" class="form-label">{{ __('Agenda File')}} *</label>
										<a target="_BLANK" class="form-control" style="border: none;width: fit-content;" href="{{asset($value->agenda_file)}}" > View & Download</a>
									</div>
									 
								</div>
							@empty
							@endforelse	
								
							</div>
							<!--<div class="col-md-6">
								<div class="col-md-2_" style="float: right;">
										<button class="btn btn-large btn-success add" type="button">Add Field</button>
								</div>
							</div> -->
							<div class="col-md-6">
							 </div>
							 
					</div>
				</div>
			</div>
		</div>
		
		<div class="card">			 
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Action Points</h4>				 
			</div>			
			<div class="card-body">
				<div class="live-preview">			
				 	<div class="row gy-4">			 
					   
						 
						<div class="col-md-12" id="attributes">
						  
							</div>
							<!-- <div class="col-md-6">
								<div class="col-md-2_" style="float: right;">
										<button class="btn btn-large btn-success add" type="button">Add Field</button>
								</div>
							</div> -->
							<div class="col-md-6">
							 </div>
							 
					</div>
				</div>
			</div>
		</div>
		
	</div>
	{{-- @can('minutes_of_meetings_edit')
		@can('approval_access')
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
			</div>
		 @else
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Update  for Approval') }}</button>
			</div>
		@endcan
	@endcan --}}
</div>
 {{-- 
@can('minutes_of_meetings_edit')
{!! Form::close() !!}
@endcan
 --}}



</div> 
@endsection
@section('script')
<script>
 // Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", { 
        url: "{{route('admin.minutes-of-meetings.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
        acceptedFiles: ".pdf",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
				this.on("sending", function(file, xhr, formData) {
				  formData.append("type", "1");
				  console.log(formData)
				});
                this.on('error', function (file, errorMessage) {
                    if (errorMessage.indexOf('Error 404') !== -1) {
                        var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                        errorDisplay[errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
                    }
                    if (errorMessage.indexOf('File is too big') !== -1) {
                        alert('Unable to upload image size is greated than 2 MB');
                        // i remove current file
                        drop.removeFile(file);
                    }
                });
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                }),
                this.on("success", function (file, response) {
                    console.log(response);
                    var hiddenImage = $('<input type="hidden" name="upload_minutes_file" value="' + response.name + '"/>');
                    $('.upload_minutes_file').html(hiddenImage);
                })
            }
    });
	
	  new Dropzone("#dropzone1", { 
        url: "{{route('admin.minutes-of-meetings.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
        acceptedFiles: ".ppt,.pptx",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
				this.on("sending", function(file, xhr, formData) {
				  formData.append("type", "0");
				  console.log(formData)
				});
                this.on('error', function (file, errorMessage) {
                    if (errorMessage.indexOf('Error 404') !== -1) {
                        var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                        errorDisplay[errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
                    }
                    if (errorMessage.indexOf('File is too big') !== -1) {
                        alert('Unable to upload image size is greated than 2 MB');
                        // i remove current file
                        drop.removeFile(file);
                    }
                });
                this.on("maxfilesexceeded", function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                }),
                this.on("success", function (file, response) {
                    console.log(response);
                    var hiddenImage = $('<input type="hidden" name="upload_final_ppt_file" value="' + response.name + '"/>');
                    $('.upload_final_ppt_file').html(hiddenImage);
                })
            }
    });


/* 1st add more  */
var i = 0;
@forelse($mom->momactionpoint as $value)
 ++i;
 
  var app_data = '<div class="col-md-12 attr" style="float: left;">';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action to be taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="{{$value->action_to_be_taken}}" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By whom")}} *</label>';
		app_data += '<select name="p_org_1['+i+'][]" class="form-select" id="byWhomeSelect" required>';
		app_data += '<option value="">Choose...</option>';
		@foreach($users as $user)
			app_data += '<option {{($value->by_whom == $user->id) ? "selected" : ""}}  value="{{$user->id}}">{{$user->name}}</option>';
		@endforeach									 
		app_data += '</select>';
		app_data += '</div>';
		app_data += '<div class="col-md-2" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By when")}} *</label>';
		app_data += '<input type="date"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="{{date("Y-m-d",strtotime($value->by_when))}}" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="{{$value->action_taken}}" required >';
		app_data += '</div>';
		 
		app_data += '<div class="col-md-1" style="float: left;">';
		app_data += '<button class="btn btn-danger remove mt-4" onclick="removeDiv(this);" type="button">';
		app_data += '<i class="mdi mdi-minus-circle"></i>';
		app_data += '</button>';
		app_data += '</div>';
		app_data += '</div>';
  $("#attributes").append(app_data);
@empty
	var app_data = '<div class="col-md-12 attr" style="float: left;">';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action to be taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By whom")}} *</label>';
		app_data += '<select name="p_org_1['+i+'][]" class="form-select" id="byWhomeSelect" required>';
		app_data += '<option value="">Choose...</option>';
		@foreach($users as $user)
			app_data += '<option  value="{{$user->id}}">{{$user->name}}</option>';
		@endforeach									 
		app_data += '</select>';
		app_data += '</div>';
		app_data += '<div class="col-md-2" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By when")}} *</label>';
		app_data += '<input type="date"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		 
		app_data += '<div class="col-md-1" style="float: left;">';
		app_data += '<button class="btn btn-danger remove mt-4" onclick="removeDiv(this);" type="button">';
		app_data += '<i class="mdi mdi-minus-circle"></i>';
		app_data += '</button>';
		app_data += '</div>';
		app_data += '</div>';
  $("#attributes").append(app_data);
@endforelse

var row = $("#partner_organisation .attr");

function addRow() {
	++i;
	 
  var app_data = '<div class="col-md-12 attr" style="float: left;">';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action to be taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By whom")}} *</label>';
		app_data += '<select name="p_org_1['+i+'][]" class="form-select" id="byWhomeSelect" required>';
		app_data += '<option value="">Choose...</option>';
		@foreach($users as $user)
			app_data += '<option  value="{{$user->id}}">{{$user->name}}</option>';
		@endforeach									 
		app_data += '</select>';
		app_data += '</div>';
		app_data += '<div class="col-md-2" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("By when")}} *</label>';
		app_data += '<input type="date"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		app_data += '<div class="col-md-3" style="float: left; padding: 5px;">';
		app_data += '<label for="labelName" class="form-label">{{ __("Action taken")}} *</label>';
		app_data += '<input type="text"  class="form-control p_org_1" id="p_org_1"  name="p_org_1['+i+'][]" value="" required >';
		app_data += '</div>';
		 
		app_data += '<div class="col-md-1" style="float: left;">';
		app_data += '<button class="btn btn-danger remove mt-4" onclick="removeDiv(this);" type="button">';
		app_data += '<i class="mdi mdi-minus-circle"></i>';
		app_data += '</button>';
		app_data += '</div>';
		app_data += '</div>';
  $("#attributes").append(app_data);
  
}

function removeRow(button) {
  button.closest("div.attr").remove();
}

$('#attributes .attr:first-child').find('.remove').hide();

/* Doc ready */
$(".add").on('click', function () {
  addRow();  
  if($("#attributes .attr").length > 1) {
    //alert("Can't remove row.");
    $(".remove").show();
  }
});
$(".remove").on('click', function () {
  if($("#attributes .attr").size() == 1) {
    //alert("Can't remove row.");
    $(".remove").hide();
  } else {
    removeRow($(this));
    
    if($("#attributes .attr").size() == 1) {
        $(".remove").hide();
    }
    
  }
});

function removeDiv($this)
{
	if($("#attributes .attr").size() == 1) {
   
    $(".remove").hide();
  } else {
    removeRow($($this));
    
    if($("#attributes .attr").size() == 1) {
        $(".remove").hide();
    }
    
  }
}
	
</script>



@endsection
