@extends('admin.layouts.app')
@section('title', 'Edit Letter/Order')
 
@section('content')

<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Publications</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
						<li class="breadcrumb-item active">Edit Publications</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
	 
 {!! Form::model($publication, ['method' => 'PATCH','route' => ['admin.publications.update', $publication->id],'files' => 'true','enctype'=>'multipart/form-data']) !!}
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
				<h4 class="card-title mb-0 flex-grow-1">Publication Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">	
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="catSelect" class="form-label">{{ __('Category') }} *</label>
								<select name="category_id" class="form-select" id="catSelect" required>
									<option value="">Choose...</option>
									@foreach($categories as $category)
										<option  {{ ($category->id == $publication->cat_id) ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
									@endforeach

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="stateSelect" class="form-label">{{ __('State') }} *</label>
								<select name="state_id[]" multiple class="form-select" data-choices data-choices-groups id="stateSelect"  onchange="showSelectedStateOptions(this)" required>
									<option value="">Choose...</option>
									<option value="All">All</option>
									@foreach($states as $state)
										<option {{ (in_array($state->state_code, explode(',',$publication->state_id) )) ? 'selected' : '' }} value="{{$state->state_code}}">{{$state->state_name}}</option>
									@endforeach

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="districtSelect" class="form-label">{{ __('District') }} *</label>
								<select name="district[]" multiple class="form-select" data-choices data-choices-groups id="districtSelect" onchange="showSelectedDistrictOptions(this)" required>
									<option value="">Choose...</option>
									{{--	@foreach(getDistrictByStateID($publication->state_id) as $district)
										<option {{ (in_array($district->id, explode(',',$publication->district) )) ? 'selected' : '' }} value="{{$district->id}}">{{$district->district_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="blockSelect" class="form-label">{{ __('Block') }} *</label>
								<select name="block[]" multiple class="form-select" data-choices data-choices-groups id="blockSelect" required>
									<option value="">Choose...</option>
									{{--	@foreach(getBlockByByDistrictID($publication->district) as $block)
										<option {{ (in_array($block->id, explode(',',$publication->block) )) ? 'selected' : '' }} value="{{$block->id}}">{{$block->block_name}}</option>
									@endforeach --}}

								</select>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="yearOfIssue" class="form-label">{{ __('Year of Issue') }} *</label>
								<input type="text" name="year_of_issue" autocomplete="off" class="form-control" id="yearOfIssue" value="{{ $publication->year_of_issue }}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="title" class="form-label">{{ __('Title') }} *</label>
								<input type="text" name="title" autocomplete="off" class="form-control" id="title" value="{{ $publication->title }}" required>
							</div>
						</div>
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="numberOfAuthors" class="form-label">{{ __('Number of Authors') }} *</label>
								<input type="text" name="number_of_authors" autocomplete="off" class="form-control" id="numberOfAuthors" value="{{ $publication->number_of_authors }}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="nameOfAuthors" class="form-label">{{ __('Name of Authors') }} *</label>
								<input type="text" name="name_of_authors" autocomplete="off" class="form-control" id="nameOfAuthors" value="{{ $publication->name_of_authors }}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="keywords" class="form-label">{{ __('Keywords') }} *</label>
								<input type="text" name="keywords" autocomplete="off" class="form-control" id="keywords" value="{{ $publication->keywords }}" required>
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="thumbnail" class="form-label">{{ __('Thumbnail') }} * (Only For jpg/jpeg)</label>
								<a target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $publication->thumbnail }}">View Document</a>
								<input type="file" name="thumbnail" class="form-control" accept="image/*" id="thumbnail" value="{{old('thumbnail')}}">
							</div>
						</div>

						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="file" class="form-label">{{ __('Document') }} * (Only For pdf 15 MB)</label>
								<a target="_blank" href="{{ asset('public/uploads/documents')}}/{{ $publication->file }}">View Document</a>
								<input type="file" name="file" class="form-control" id="file" accept="application/pdf" value="{{old('file')}}">
							</div>
						</div>
						@can('approve_media_publication')
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }}*</label>
								<select name="status" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{($publication->status == '1') ? 'selected': ''}} value="1">Approve</option>
									<option {{($publication->status == '0') ? 'selected': ''}} value="0">Not Approved</option>
								</select>
							</div>
						</div>
						@else
							<input type="hidden" name="status" value="{{ $publication->status }}">
						@endcan

						<!--end col-->
						<div class="col-xxl-12 col-md-12">
							<div>
								<label for="description" class="form-label">{{ __('Description') }} *</label>
								<textarea name="description" class="form-control">{{ $publication->description }}</textarea>
							</div>
						</div>
						 <!--end col-->


						{{--<div class="col-xxl-3 col-md-6">--}}
							{{--<div>--}}
								{{--<label for="labelNumberOfUsers" class="form-label">{{ __('Upload Doc (pdf)') }} *</label>--}}
								{{--<div id="dropzone" class="dropzone" >--}}
								 {{----}}
								{{--</div>--}}
                                    {{--<div class="hidden_images_logo"><input type="hidden" name="logo_hidden_images" value="{{ old('logo_hidden_images') }}"/>--}}
                                    {{--</div>--}}
								 {{----}}
							{{--</div>--}}
						{{--</div>--}}
						 
						<!--end col-->
						 	  
								
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
	</div>
</div>
  

{!! Form::close() !!}



</div> 
@endsection
@section('script')
<script>
 // Dropzone has been added as a global variable.
    const dropzone = new Dropzone("#dropzone", { 
        url: "{{route('admin.publications.storeMedia')}}",
        paramName: "file",
        maxFilesize: 1,
        maxFiles: 1,
        acceptedFiles: ".pdf",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function () {
                var drop = this; // Closure
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
                    var hiddenImage = $('<input type="hidden" name="logo_hidden_images" value="' + response.name + '"/>');
                    $('.hidden_images_logo').html(hiddenImage);
                })
            }
    });

</script>
@php 
$selected_district = explode(',',$publication->district);

@endphp
<script>
var state = $('#stateSelect');
 
showSelectedStateOptions(state);
function showSelectedStateOptions($this)
{
	var arr = $($this).val();
	//console.log(arr);
	if(arr == 'All')
	{
		 var option ='';
		option +='<option value="All">All</option>';
		$('#districtSelect').html(option);
		$('#blockSelect').html('');
	}else{
	$.ajax({
			url: "{{ route('admin.publications.getDistrictListByStates') }}",
			method: "POST",
			dataType: 'json',
			data: {
				'state_ids': arr,
				 
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				var districts = '{{$publication->district}}';
				var distrct_ids = districts.split(',').map(Number);
				var selected = '';
				$('#districtSelect').html('');
				   var option ='';
				   option +='<option value="">Select District...</option>'; 
				   
				   if(result!=null){
						 $.each(result, function(i, item) {
							 var district_code = item.district_code;							 
							 if(jQuery.inArray(district_code, distrct_ids) !== -1)
							 {
								 selected = 'selected';
							 }else{
								 selected = '';
							 }
                          option +="<option "+selected+" value='"+item.district_code+"'>"+item.district_name+"</option>";
                      });
				   }
				 $('#districtSelect').html(option);
				 var districts = $('#districtSelect');
				 showSelectedDistrictOptions(districts);
			}
		});
	}
}


 

function showSelectedDistrictOptions($this)
{
	var arr = $($this).val();
	
	if(arr == 'All')
	{
		var option ='';
		option +='<option value="All">All</option>';
		$('#blockSelect').html(option);
	}else{
	$.ajax({
			url: "{{ route('admin.publications.getBlockListByStates') }}",
			method: "POST",
			dataType: 'json',
			data: {
				'district_ids': arr,
				 
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result) {
				var blocks = '{{$publication->block}}';
				var block_ids = blocks.split(',').map(Number);
				var selected = '';
				$('#blockSelect').html('');
				   var option ='';
				   option +='<option value="">Select Block...</option>'; 
				   
				   if(result!=null){
						 $.each(result, function(i, item) {
							var block_code = item.block_code;							 
							 if(jQuery.inArray(block_code, block_ids) !== -1)
							 {
								 selected = 'selected';
							 }else{
								 selected = '';
							 }
                          option +="<option "+selected+" value='"+item.block_code+"'>"+item.block_name+"</option>";
                      });
				   }
				 $('#blockSelect').html(option);
			}
		});
	}
}

</script>

@endsection
