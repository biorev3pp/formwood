<div>
    <div class="table-responsive bg-white">
        <table class="table table-striped biorev-table">
            <thead>
                <tr class="text-uppercase">
                    <th class="sno">SNo</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Remark</th>
                    <th class="action-3">Status</th>
                    <th class="action-3">
                        <button class="icon-btn" type="button" onclick="addCategory(false)">
                            <i class="ft-plus-square text-primary"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="recordBody">
                @if(count($collection) >= 1)
                    @foreach ($collection as $key => $item)    
                        <tr id="row{{$item->id}}">
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>
                                <img src="{{ $MEDIA_URL.'/'.$item->image }}" class="img-thumb" />
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                <span class="{{ $item->status->label }}">
                                    {!! $item->status->icon !!} {{ $item->status->status }}
                                </span>
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addCategory(true, '{{$item->name}}', {{$item->status_id}}, '{{$item->image}}', '{{$item->remark}}', {{$item->id}}, {{ $key+1}})">
                                    <i class="ft-edit"></i>
                                </a>
                                <a class="table-icon-btn text-danger" href="javascript:void(0);" onclick="deleteSwal({{$item->id}})">
                                    <i class="ft-trash-2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">
                            <p class="text-danger p-0 m-0">
                                No items found in collection.
                            </p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade text-left croppergap" id="addRecordModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="recordForm">
                <div class="modal-header border-bottom">
                    <h3 class="modal-title"> Add New Cut</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ft-x text-secondary"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label class="text-uppercase">Name</label>
                                <input id="name" class="form-control border px-50" type="text" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">Remark</label>
                                <textarea id="remark" name="remark" class="form-control border px-50"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="d-inline-block mr-1 text-uppercase m-0">Activate </label>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" name="status" class="custom-control-input" id="yes1" value="1">
                                    <label class="custom-control-label" for="yes1">Yes</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio"name="status" class="custom-control-input" id="no1" value="2" checked>
                                    <label class="custom-control-label" for="no1">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-7">
                            <label class="text-uppercase mb-0">Image</label>
                            <div class="form-group d-flex flex-wrap justify-content-between">
                                <div class="mr-2" style="width: calc(100% - 250px);">
                                    <div class="mb-50 crop-actions">
                                        <span>
                                            <input type="file" id="newimage" class="d-none">
                                            <label class="btn btn-sm btn-secondary m-0" style="padding:0.59375rem 1rem" for="newimage"> <i class="ft-image"></i> Choose Image</label>
                                        </span>
                                        <button type="button" class="btn btn-sm btn-primary mx-50 skipcropbtn" onclick="skipCropping()">Skip Cropping</button>
                                        <button type="button" class="btn btn-sm btn-danger resetbtn" onclick="resetCropping()">Reset Cropper</button>
                                    </div>
                                    <img id="image" src="{{asset('media/placeholder.jpg')}}" />
                                </div>
                                <div class="" style="width:200px">
                                    <label class="text-uppercase mb-0">Cropping Preview</label>
                                    <div class="mb-1">(<span id="imgw"></span> x <span id="imgh"></span>px)</div>
                                    <div class="croppreview">
                                        <figure class="position-relative w-full mb-0">
                                            <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail preview">
                                        </figure>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-success mx-50 applycropbtn" onclick="applyCropping()" style="display: none">Done With Cropping</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-1">
                    <button type="button" id="submitButton" onclick="submitForm(false)" data-id="" class="btn btn-dark text-white m-0 px-2"> 
                        <span class="button-text"> Save Changes </span>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const path = '{{$MEDIA_URL}}';
    const date = new Date();
    let baseImage = null, isChange = null;
    var image = document.getElementById("image");
    var cropper;

    function addCategory(...values){
        isChange = null;
        baseImage = null;
        const modal = $('#addRecordModal');

        if(values[0] == true){
            modal.find('.modal-title').text('Edit Cut')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#recordForm input[name="status"]');

            modal.find('#name').val(values[1]);
            $.each(radioButtons, function(){
                if($(this).val() == values[2]){
                    $(this).prop('checked', true);
                }
            });
           
            if(values[3] != ""){
                modal.find('.preview').attr('src', `${path}/${values[3]}`);
            }
            modal.find('#remark').val(values[4]);
            modal.find('#submitButton').attr('data-id', values[5]);
            modal.find('#submitButton').attr('data-rid', values[6]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('recordForm');
            modal.find('.modal-title').text('Add New Cut')
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
        if(baseImage == null){
            toastr.clear()
            toastr.error('Image is required');
            return false;
        }

       /*  if (fileType(baseImage) != "jpeg" && fileType(baseImage) != "jpg" && fileType(baseImage) != "png") {
            toastr.clear()
            toastr.error('Only jpeg, jpg, png formats are allowed for image');
            return false;
        } */
    }

    const editImageValidation = () => {
        if(isChange == 'view'){
            if(baseImage == null){
                toastr.clear()
                toastr.error('Image is required');
                return false;
            }
            /* if (fileType(baseImage) != "jpeg" && fileType(baseImage) != "jpg" && fileType(baseImage) != "png") {
                toastr.clear()
                toastr.error('Only jpeg, jpg, png formats are allowed for view 1 base image');
                return false;
            } */
        }
    }

    function submitForm(editable){
        
        const name = $('#name').val();
        const remark = $('#remark').val();
        const status = $('input[name="status"]:checked').val();

        // Validations
        if(name == ''){
            toastr.clear()
            toastr.error('Name field is required');
            return false;
        }

        if(!(/^[A-Za-z0-9-_() ]+$/.test(name))){
            toastr.clear()
            toastr.error('Name field should only contain alphabets and numbers.');
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

        formData.append('name', name);
        formData.append('status', status);
        formData.append('image', baseImage);
        formData.append('remark', remark);
        $("#add Modal").find('#submitButton').addClass('disable');
        $("#addRecordModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addRecordModal").find('#submitButton .spinner-border').addClass('show-spinner');
        
        if(editable == true){
            const HomePlanId = $("#submitButton").attr('data-id');
            const RowId = $("#submitButton").attr('data-rid');
            formData.append('id', HomePlanId);

            $.ajax({
                type: 'POST',
                url: siteURL+'/api/update/cuts/'+HomePlanId,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Product category has been updated successfully.');
                    let card = null;
                    card = `<td>${RowId}</td>
                            <td>
                                <img src="${path}/${response.image}" class="img-thumb" />
                            </td>
                            <td>
                                ${response.name}
                            </td>
                            <td>
                                ${response.remark}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addCategory(true, '${response.name}', '${response.status_id}', '${response.image}', ${response.id}, '${RowId}')">
                                    <i class="ft-edit"></i>
                                </a>
                                <a class="table-icon-btn text-danger" href="javascript:void(0);" onclick="deleteSwal(${response.id})">
                                    <i class="ft-trash-2"></i>
                                </a>
                            </td>`;
                    $(`#row${response.id}`).html(card);
                    $('#addRecordModal').modal('hide');
                    $("#addRecordModal").find('#submitButton').removeClass('disable');
                    $("#addRecordModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addRecordModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
        else{
            let RowId = $('#recordBody').children().length+1;
            $.ajax({
                type: 'POST',
                url: siteURL+'/api/create/cuts',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Product category has been added successfully.');
                    let card = null;
                    card = `<tr id="row${response.id}">
                            <td>${RowId}</td>
                            <td>
                                <img src="${path}/${response.image}" class="img-thumb" />
                            </td>
                            <td>
                                ${response.name}
                            </td>
                            <td>
                                ${response.remark}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addCategory(true, '${response.name}', '${response.status_id}', '${response.image}', ${response.id}, '${RowId}')">
                                    <i class="ft-edit"></i>
                                </a>
                                <a class="table-icon-btn text-danger" href="javascript:void(0);" onclick="deleteSwal(${response.id})">
                                    <i class="ft-trash-2"></i>
                                </a>
                            </td>
                        </tr>`;
                    $('#recordBody').append(card);
                    $('#addRecordModal').modal('hide');
                    $("#addRecordModal").find('#submitButton').removeClass('disable');
                    $("#addRecordModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addRecordModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                    baseImage = null;
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
                $('.preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            baseImage = input.files[0];
            isChange == 'view';
            
        }
    }

    $("body").on("change", "#newimage", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
        $('.croppreview').addClass('croppreviewcss');
        cropper = new Cropper(image, {
            viewMode: 0,
            preview: ".croppreview",
        });
        $('.applycropbtn').show();
    });
    
    image.addEventListener('cropstart', (event) => {
        $('#imgw').html($('.cropper-crop-box').width())
        $('#imgh').html($('.cropper-crop-box').height())
    });

    function applyCropping() {
        canvas = cropper.getCroppedCanvas();
        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                baseImage = reader.result;
                $('.applycropbtn').hide();
                cropper.destroy();
                cropper = null;
                $('#image').attr('src', '{{asset("media/placeholder.jpg")}}');
                $('.croppreview').removeClass('croppreviewcss').html(`<figure class="position-relative w-full mb-0"><img src="${baseImage}" class="img-thumbnail preview"></figure>`);
            };
        });
    }

    function skipCropping() {
        cropper.destroy();
        cropper = null;
        baseImage = $('#image').attr('src');
        $('#image').attr('src', '{{asset("media/placeholder.jpg")}}');
        $('.croppreview').removeClass('croppreviewcss').html(`<figure class="position-relative w-full mb-0"><img src="${baseImage}" class="img-thumbnail preview"></figure>`);
        $('.applycropbtn').hide();
    }

    function resetCropping() {
        cropper.destroy();
        cropper = null;
        $('#image').attr('src', '{{asset("media/placeholder.jpg")}}');
        $('.croppreview').removeClass('croppreviewcss').html(`<figure class="position-relative w-full mb-0"><img src="${path}/placeholder.jpg" class="img-thumbnail preview"></figure>`);
        $('.applycropbtn').hide();
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
                deleteRecord(HomePlanId);
                Swal.fire(
                'Deleted!',
                'Cut has been deleted.',
                'success'
                )
            }
        })
    }

    function deleteRecord(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete/cuts',
            data: {id: id },
            success: function(){
                $(`#row${id}`).remove();
            }
        });
    }
</script>
@endpush