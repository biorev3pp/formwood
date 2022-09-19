@extends('layouts.inner')
@section('content')
<div class="content-header d-flex flex-wrap justify-content-between align-items-center bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Floorplans</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper pl-1">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('floorplan')}}">Homes</a>
                    </li>
                    <li class="breadcrumb-item"><u class="ml-25">Floorplans : {{ ucwords($home_title.' - '.$elevation_title) }}</u>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="{{route('floorplan')}}" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
            <i class="ft-arrow-left"></i>
            <span>Back</span>
        </a> 
        <a href="javascript:;" onclick="FloorPlanModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 standard-button"> 
            <i class="ft-plus"></i>
            <span>Add New</span>
        </a>  
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        @if(count($floorplans) > 0)
            @foreach($floorplans as $floorplan)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card" id="card{{$floorplan->id}}">
                    <div class="card-header">
                        <h4 class="card-title text-capitalize"><b>{{$floorplan->title}}</b>
                            <div class="heading-elements">
                                @if($floorplan->status_id == 1)
                                    <span class="badge badge-success text-uppercase">active</span>
                                @elseif($floorplan->status_id == 0)
                                    <span class="badge badge-danger text-uppercase">deactive</span>
                                @endif
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <img class="img-fluid" src="{{asset('media/uploads/floorplan/base-image/'.$floorplan->image)}}">
                    </div>
                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                        <span class="float-left">Updated On: {{date('d-m-Y',strtotime($floorplan->updated_at))}}</span>
                        <span class="float-right">
                        <a href="{{ route('homeplan-acl-settings', ['homeplan_id' => base64_encode($floorplan->id)]) }}" title="ACL Settings" class="text-dark mr-25"><i class="ft-settings"></i></a>
                        <a href="{{route('homeplan-features',['floorplan_id' => base64_encode($floorplan->id)])}}" data-toggle="tooltip" title="View Features" class="text-dark mr-25"> <i class="ft-eye"></i> </a>                     
                        <a href="javascript:;" onclick="FloorPlanModal(true, '{{$floorplan->title}}', '{{$floorplan->status_id}}', '{{$floorplan->image}}',{{$floorplan->id}})" data-toggle="tooltip" title="Edit Homeplan" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal({{$floorplan->id}})" data-toggle="tooltip" title="Delete Homeplan" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
<div class="modal fade text-left" id="addFloorPlanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h3 class="modal-title"> Add New Floorplan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ft-x text-secondary"></i>
                </button>
            </div>
            <form id="designForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-uppercase">Title</label>
                        <input id="title" class="form-control border" type="text" placeholder="Enter title" required>
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-start">
                        <div class="mr-1">
                            <label for="view1Image" class="text-uppercase mb-1">Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="view1Image" class="d-none" onchange="readUrl(this,'view1')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="view1Image"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block mr-1 text-uppercase m-0">Activate </label>
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" class="custom-control-input" id="yes1" value="1">
                            <label class="custom-control-label" for="yes1">Yes</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio"name="status" class="custom-control-input" id="no1" value="0" checked>
                            <label class="custom-control-label" for="no1">No</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitButton" onclick="submitForm(true)" data-id="" data-floorplan-id="" data-elevation-id="{{ $elevation_id }}" data-home-id="{{ $home_id }}" class="btn btn-dark text-white m-0"> <span class="button-text"> Save Changes </span>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const path = '{{asset("media/uploads/floorplan")}}';
    const pathBaseImage = '{{asset("media/uploads/floorplan/base-image")}}';
    const pathThumbnail = '{{asset("media/uploads/floorplan/thumbnails")}}';
    const date = new Date();
    let view1BaseImage = null, isChange = null;
    let thumbnailImage = null, isChangeThumb = false;
    function FloorPlanModal(...values){        
        isChange = null;
        view1BaseImage = null;
        const modal = $('#addFloorPlanModal');
        if(values[0] == true){
            modal.find('.modal-title').text('Edit Floorplan')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#designForm input[name="status"]');
            modal.find('#title').val(values[1]);
            $.each(radioButtons, function(){
                if($(this).val() == values[2]){
                    $(this).prop('checked', true);
                }
            });
            if(values[3] != ""){
                modal.find('#view1Image').prev().attr('src', `${pathBaseImage}/${values[3]}`);
            }
            modal.find('#submitButton').attr('data-floorplan-id', values[4]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Floorplan')
            modal.find('.modal-footer button .button-text').text('Add New')
            modal.find('.img-thumbnail').attr('src', '{{asset("media/placeholder.jpg")}}')
            modal.find('#submitButton').attr('data-id', '');
            modal.find('#submitButton').attr('onclick', 'submitForm(false)');
            form.reset();
            modal.modal('show');
        }
    }

    // Get FileType
    const fileType = (file) => {
        return file.type.split('/').pop().toLowerCase();
    }

    const imageValidation = () => {
        if(view1BaseImage == null){
            toastr.clear()
            toastr.error('View 1 Base Image is required');
            return false;
        }

        if (fileType(view1BaseImage) != "jpeg" && fileType(view1BaseImage) != "jpg" && fileType(view1BaseImage) != "png") {
            toastr.clear()
            toastr.error('Only jpeg, jpg, png formats are allowed for view 1 base image');
            return false;
        }

    }

    const editImageValidation = () => {
        if(isChange == 'view1'){
            if(view1BaseImage == null){
                toastr.clear()
                toastr.error('View 1 Base Image is required');
                return false;
            }
            if (fileType(view1BaseImage) != "jpeg" && fileType(view1BaseImage) != "jpg" && fileType(view1BaseImage) != "png") {
                toastr.clear()
                toastr.error('Only jpeg, jpg, png formats are allowed for view 1 base image');
                return false;
            }
        }
    }

    function submitForm(editable){
        
        const title = $('#title').val();
        const status = $('input[name="status"]:checked').val();

        // Validations
        if(title == ''){
            toastr.clear()
            toastr.error('Title field is required');
            return false;
        }

        if(!(/^[A-Za-z ]+$/.test(title))){
            toastr.clear()
            toastr.error('Title field should only contain alphabets.');
            return false;
        }
    

        if(editable == true){
            if(editImageValidation() == false){
                return false;
            }
        }
        else{
            if(imageValidation() == false){
                return false;
            }
        }

        const formData = new FormData();

        formData.append('title', title);
        formData.append('status', status);
        formData.append('base_image', view1BaseImage);
        $("#add Modal").find('#submitButton').addClass('disable');
        $("#addFloorPlanModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addFloorPlanModal").find('#submitButton .spinner-border').addClass('show-spinner');
        const elevation_id = $("#submitButton").attr('data-elevation-id');
        formData.append('elevation_id', elevation_id);
        const home_id = $("#submitButton").attr('data-home-id');
        formData.append('home_id', home_id);
        
        if(editable == true){
            const floorplan_id = $("#submitButton").attr('data-floorplan-id');
            formData.append('floorplan_id', floorplan_id);
            $.ajax({
                type: 'post',
                url: '/api/edit-floorplan',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    const parent = $(`#card${response.id}`);
                    parent.find('.card-title b').text(response.title);
                    parent.find('.card-content .img-fluid').attr('src',`${pathBaseImage}/${response.image}`);
                    if(response.status_id == 1){
                        parent.find('.heading-elements').html('<span class="badge badge-success text-uppercase">active</span>');
                    }
                    else if(response.status_id == 0){
                        parent.find('.heading-elements').html('<span class="badge badge-danger text-uppercase">deactive</span>');
                    }

                    parent.find('.edit-button').attr('onclick', `FloorPlanModal(true, '${response.title}', '${response.status_id}', '${response.image}', ${response.id})`);
                    $('#addFloorPlanModal').modal('hide');
                    $("#addFloorPlanModal").find('#submitButton').removeClass('disable');
                    $("#addFloorPlanModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addFloorPlanModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
        else{
            $.ajax({
                type: 'post',
                url: '/api/add-floorplan',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    let card = null;
                    card = `<div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="card" id="card${response.id}">
                                    <div class="card-header">
                                        <h4 class="card-title text-capitalize"><b>${response.title}</b>
                                            <div class="heading-elements">
                                                ${(response.status_id == 1)?'<span class="badge badge-success text-uppercase">active</span>':'<span class="badge badge-danger text-uppercase">deactive</span>'}
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <img class="img-fluid" src="${pathBaseImage}/${response.image}">
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <span class="float-left">Updated On: ${date.getDate(response.updated_at)}-${date.getMonth(response.updated_at)}-${date.getFullYear(response.updated_at)}</span>
                                        <span class="float-right">
                                            ${response.html}
                                            <a href="javascript:;" onclick="FloorPlanModal(true, '${response.title}', '${response.status_id}', '${response.image}',${response.id})" data-toggle="tooltip" title="Edit Floorplan" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                                            <a href="javascript:;" onclick="deleteSwal(${response.id})" data-toggle="tooltip" title="Delete Floorplan" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                                        </span>
                                    </div>
                                </div>
                            </div>`;
                    $('.content-wrapper .row').append(card);
                    $('#addFloorPlanModal').modal('hide');
                    $("#addFloorPlanModal").find('#submitButton').removeClass('disable');
                    $("#addFloorPlanModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addFloorPlanModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
    }

    function readUrl(input, element) {
        if (input.files && input.files[0]) 
        {  
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $(input).prev().attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            if(element == 'view1'){
                view1BaseImage = input.files[0];
                console.log(view1BaseImage)
                isChange == 'view1';
            }
        }
    }

    function deleteSwal(floorplanId){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteFloorPlan(floorplanId);
                Swal.fire(
                'Deleted!',
                'Homeplan has been deleted.',
                'success'
                )
            }
        })
    }

    function deleteFloorPlan(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete-floorplan',
            data: {id: id },
            success: function(){
                $(`#card${id}`).parent().remove();
            }
        });
    }
</script>
@endpush
