@extends('layouts.inner')
@section('content')
<div class="content-header d-flex flex-wrap justify-content-between align-items-center bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Design Groups</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper pl-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('interior')}}">Design Groups</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="javascript:;" onclick="designGroupModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 standard-button"> 
            <i class="ft-plus"></i>
            <span>Add New</span>
        </a>  
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        @foreach($design_groups as $design_group)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card" id="card{{$design_group->id}}">
                <div class="card-header">
                    <h4 class="card-title text-capitalize"><b>{{$design_group->title}}</b>
                        <div class="heading-elements">
                            @if($design_group->status_id == 1)
                                <span class="badge badge-success text-uppercase">active</span>
                            @elseif($design_group->status_id == 0)
                                <span class="badge badge-danger text-uppercase">deactive</span>
                            @endif
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <img class="img-fluid" src="{{asset('media/uploads/'.$design_group->base_image_view1)}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: {{date('d-m-Y',strtotime($design_group->updated_at))}}</span>
                    <span class="float-right">
                        <a href="{{route('design-types',['design_group_id' => base64_encode($design_group->id)])}}" data-toggle="tooltip" title="View Design Types" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="designGroupModal(true, '{{$design_group->title}}', '{{$design_group->status_id}}', '{{$design_group->base_image_view1}}', '{{$design_group->base_image_view2}}',{{$design_group->id}},'{{$design_group->view1_title}}','{{$design_group->view2_title}}' )" data-toggle="tooltip" title="Edit Design Group" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal({{$design_group->id}})" data-toggle="tooltip" title="Delete Design Group" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade text-left" id="addDesignGroupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h3 class="modal-title"> Add New Design Group</h3>
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
                            <label class="text-uppercase mb-1">Base Image</label>
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
    const path = '{{asset("media/uploads")}}';
    const date = new Date();
    let view1BaseImage = null, isChange = null;
    function designGroupModal(...values){
        isChange = null;
        view1BaseImage = null;
        const modal = $('#addDesignGroupModal');
        if(values[0] == true){
            modal.find('.modal-title').text('Edit Design Group')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#designForm input[name="status"]');
            modal.find('#title').val(values[1]);
            $.each(radioButtons, function(){
                if($(this).val() == values[2]){
                    $(this).prop('checked', true);
                }
            });
            if(values[3] != ""){
                modal.find('#view1Image').prev().attr('src', `${path}/${values[3]}`);
            }
            modal.find('#submitButton').attr('data-id', values[5]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Design Group')
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

        if(!(/^[A-Za-z0-9 ]+$/.test(title))){
            toastr.clear()
            toastr.error('Title field should only contain alphabets or numbers.');
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
        formData.append('view1_base_image', view1BaseImage);
        $("#addDesignGroupModal").find('#submitButton').addClass('disable');
        $("#addDesignGroupModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addDesignGroupModal").find('#submitButton .spinner-border').addClass('show-spinner');
        
        if(editable == true){
            const designGroupId = $("#submitButton").attr('data-id');
            formData.append('design_group_id', designGroupId);

            $.ajax({
                type: 'post',
                url: '/api/edit-design-group',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    const parent = $(`#card${response.id}`);
                    parent.find('.card-title b').text(response.title);
                    parent.find('.card-content .img-fluid').attr('src',`${path}/${response.base_image_view1}`);
                    if(response.status_id == 1){
                        parent.find('.heading-elements').html('<span class="badge badge-success text-uppercase">active</span>');
                    }
                    else if(response.status_id == 0){
                        parent.find('.heading-elements').html('<span class="badge badge-danger text-uppercase">deactive</span>');
                    }

                    parent.find('.edit-button').attr('onclick', `designGroupModal(true, '${response.title}', '${response.status_id}', '${response.base_image_view1}', '${response.base_image_view2}', ${response.id}, '${response.view1_title}', '${response.view2_title}')`);
                    $('#addDesignGroupModal').modal('hide');
                    $("#addDesignGroupModal").find('#submitButton').removeClass('disable');
                    $("#addDesignGroupModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addDesignGroupModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
        else{
            $.ajax({
                type: 'post',
                url: '/api/add-design-group',
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
                                        <img class="img-fluid" src="${path}/${response.base_image_view1}">
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <span class="float-left">Updated On: ${date.getDate(response.updated_at)}-${date.getMonth(response.updated_at)}-${date.getFullYear(response.updated_at)}</span>
                                        <span class="float-right">
                                            <a href="/admin/design-groups/design-types/${btoa(response.id)}" data-toggle="tooltip" title="View Design Types" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                                            <a href="javascript:;" onclick="designGroupModal(true, '${response.title}', '${response.status_id}', '${response.base_image_view1}', '${response.base_image_view2}',${response.id})" data-toggle="tooltip" title="Edit Design Group" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                                            <a href="javascript:;" onclick="deleteSwal(${response.id})" data-toggle="tooltip" title="Delete Design Group" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                                        </span>
                                    </div>
                                </div>
                            </div>`;
                    $('.content-wrapper .row').append(card);
                    $('#addDesignGroupModal').modal('hide');
                    $("#addDesignGroupModal").find('#submitButton').removeClass('disable');
                    $("#addDesignGroupModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addDesignGroupModal").find('#submitButton .spinner-border').removeClass('show-spinner');
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
            else if(element == 'view2'){
                view2BaseImage = input.files[0];
                isChange == 'view2';
            }
        }
    }

    function deleteSwal(designGroupId){
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
                deleteDesignGroup(designGroupId);
                Swal.fire(
                'Deleted!',
                'Design Group has been deleted.',
                'success'
                )
            }
        })
    }

    function deleteDesignGroup(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete-design-group',
            data: {design_group_id: id },
            success: function(){
                $(`#card${id}`).parent().remove();
            }
        });
    }
</script>
@endpush