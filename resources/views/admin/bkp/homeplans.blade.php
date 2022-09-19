@extends('layouts.inner')
@section('content')
<div class="content-header d-flex flex-wrap justify-content-between align-items-center bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Homeplans</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper pl-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Homeplans
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="javascript:;" onclick="HomePlanModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 standard-button"> 
            <i class="ft-plus"></i>
            <span>Add New</span>
        </a>  
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        @foreach($homes as $home)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card" id="card{{$home->id}}">
                <div class="card-header">
                    <h4 class="card-title text-capitalize"><b>{{$home->title}}</b>
                        <div class="heading-elements">
                            @if($home->status_id == 1)
                                <span class="badge badge-success text-uppercase">active</span>
                            @elseif($home->status_id == 0)
                                <span class="badge badge-danger text-uppercase">deactive</span>
                            @endif
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <img class="img-fluid" src="{{asset('media/uploads/exterior/'.$home->base_image)}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left suboption">
                        @if($home->exterior == 1) <b class="badge badge-success">E</b> @endif
                        @if($home->floorplan == 1) <b class="badge badge-success">F</b> @endif
                    </span>
                    <span class="float-right">
                        <a href="{{route('elevations',['home_id' => base64_encode($home->id)])}}" data-toggle="tooltip" title="View Elevations" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="HomePlanModal(true, '{{$home->title}}', '{{$home->status_id}}', '{{$home->base_image}}',{{$home->id}},{{$home->exterior}},{{$home->floorplan}})" data-toggle="tooltip" title="Edit Homeplan" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal({{$home->id}})" data-toggle="tooltip" title="Delete Homeplan" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade text-left" id="addHomePlanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h3 class="modal-title"> Add New Homeplan</h3>
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
                        <div class="mr-2">
                            <label class="text-uppercase">Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="view1Image" class="d-none" onchange="readUrl(this,'view1')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="view1Image"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div class="mr-2">
                            <div class="mb-3">
                                <label class="text-uppercase">Enable For Exterior</label>
                                <div class="d-block ml-2">
                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                        <input type="radio" name="exterior" class="custom-control-input" id="exterioryes1" value="1">
                                        <label class="custom-control-label" for="exterioryes1">Yes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio">
                                        <input type="radio"name="exterior" class="custom-control-input" id="exteriorno1" value="0" checked>
                                        <label class="custom-control-label" for="exteriorno1">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="text-uppercase">Enable For Floorplan</label>
                                <div class="d-block ml-2">
                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                        <input type="radio" name="floorplan" class="custom-control-input" id="floorplanyes1" value="1">
                                        <label class="custom-control-label" for="floorplanyes1">Yes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio">
                                        <input type="radio"name="floorplan" class="custom-control-input" id="floorplanno1" value="0" checked>
                                        <label class="custom-control-label" for="floorplanno1">No</label>
                                    </div>
                                </div>
                            </div>
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
                    <button type="button" id="submitButton" onclick="submitForm(true)" data-id="" class="btn btn-dark text-white m-0"> <span class="button-text"> Save Changes </span>
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
    const path = '{{asset("media/uploads/exterior")}}';
    const date = new Date();
    let view1BaseImage = null, isChange = null;

    function HomePlanModal(...values)
    {
        console.log(...values)
        isChange = null;
        view1BaseImage = null;
        const modal = $('#addHomePlanModal');
        if(values[0] == true){
            modal.find('.modal-title').text('Edit Homeplan')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#designForm input[name="status"]');
            const radioButtons2 = $('#designForm input[name="exterior"]');
            const radioButtons3 = $('#designForm input[name="floorplan"]');
            modal.find('#title').val(values[1]);
            $.each(radioButtons, function(){
                if($(this).val() == values[2]){
                    $(this).prop('checked', true);
                }
            });
            $.each(radioButtons2, function(){
                if($(this).val() == values[5]){
                    $(this).prop('checked', true);
                }
            });
            $.each(radioButtons3, function(){
                if($(this).val() == values[6]){
                    $(this).prop('checked', true);
                }
            });
            if(values[3] != ""){
                modal.find('#view1Image').prev().attr('src', `${path}/${values[3]}`);
            }
            modal.find('#submitButton').attr('data-id', values[4]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Homeplan')
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
        const exterior = $('input[name="exterior"]:checked').val();
        const floorplan = $('input[name="floorplan"]:checked').val();

        // Validations
        if(title == ''){
            toastr.clear()
            toastr.error('Title field is required');
            return false;
        }

        if(!(/^[A-Za-z0-9 ]+$/.test(title))){
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
        formData.append('exterior', exterior);
        formData.append('floorplan', floorplan);
        formData.append('base_image', view1BaseImage);
        $("#add Modal").find('#submitButton').addClass('disable');
        $("#addHomePlanModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addHomePlanModal").find('#submitButton .spinner-border').addClass('show-spinner');
        
        if(editable == true){
            const HomePlanId = $("#submitButton").attr('data-id');
            formData.append('home_id', HomePlanId);

            $.ajax({
                type: 'post',
                url: '/api/edit-homeplan',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    const parent = $(`#card${response.id}`);
                    parent.find('.card-title b').text(response.title);
                    parent.find('.card-content .img-fluid').attr('src',`${path}/${response.base_image}`);
                    if(response.status_id == 1){
                        parent.find('.heading-elements').html('<span class="badge badge-success text-uppercase">active</span>');
                    }
                    else if(response.status_id == 0){
                        parent.find('.heading-elements').html('<span class="badge badge-danger text-uppercase">deactive</span>');
                    }

                    if(response.exterior == 1 && response.floorplan == 1){
                        parent.find('.suboption').html('<b class="badge badge-success">E</b> <b class="badge badge-success">F</b>');
                    }
                    else if(response.exterior == 1 && response.floorplan == 0){
                        parent.find('.suboption').html('<b class="badge badge-success">E</b>');
                    }
                    else if(response.exterior == 0 && response.floorplan == 1){
                        parent.find('.suboption').html('<b class="badge badge-success">F</b>');
                    }
                    else {
                        parent.find('.suboption').html('');
                    }

                    parent.find('.edit-button').attr('onclick', `HomePlanModal(true, '${response.title}', '${response.status_id}', '${response.base_image}', ${response.id},${response.exterior},${response.floorplan})`);
                    $('#addHomePlanModal').modal('hide');
                    $("#addHomePlanModal").find('#submitButton').removeClass('disable');
                    $("#addHomePlanModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addHomePlanModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
        else{
            $.ajax({
                type: 'post',
                url: '/api/add-homeplan',
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
                                        <img class="img-fluid" src="${path}/${response.base_image}">
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <span class="float-left">
                                            ${(response.exterior == 1)?'<b class="badge badge-success">E</b> ':''}
                                            ${(response.floorplan == 1)?'<b class="badge badge-success">F</b>':''}
                                        </span>
                                        <span class="float-right">
                                            <a href="/admin/homeplans/elevations/${btoa(response.id)}" data-toggle="tooltip" title="View Elevations" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                                            <a href="javascript:;" onclick="HomePlanModal(true, '${response.title}', '${response.status_id}', '${response.base_image}', '${response.base_image_view2}',${response.id},${response.exterior},${response.floorplan})" data-toggle="tooltip" title="Edit Homeplan" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                                            <a href="javascript:;" onclick="deleteSwal(${response.id})" data-toggle="tooltip" title="Delete Homeplan" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                                        </span>
                                    </div>
                                </div>
                            </div>`;
                    $('.content-wrapper .row').append(card);
                    $('#addHomePlanModal').modal('hide');
                    $("#addHomePlanModal").find('#submitButton').removeClass('disable');
                    $("#addHomePlanModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addHomePlanModal").find('#submitButton .spinner-border').removeClass('show-spinner');
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
                isChange == 'view1';
            }
        }
    }

    function deleteSwal(HomePlanId){
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
                deleteHomePlan(HomePlanId);
                Swal.fire(
                'Deleted!',
                'Homeplan has been deleted.',
                'success'
                )
            }
        })
    }

    function deleteHomePlan(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete-homeplan',
            data: {home_id: id },
            success: function(){
                $(`#card${id}`).parent().remove();
            }
        });
    }
</script>
@endpush