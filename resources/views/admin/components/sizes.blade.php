<div>
    <div class="table-responsive bg-white">
        <table class="table table-striped biorev-table">
            <thead>
                <tr class="text-uppercase">
                    <th class="sno">SNo</th>
                    <th>Product Category</th>
                    <th>Size</th>
                    <th>Remark</th>
                    <th class="action-3">Status</th>
                    <th class="action-3">
                        <button class="icon-btn" type="button" onclick="addSize(false)">
                            <i class="ft-plus-square text-primary"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="recordBody">
                @if(count($collection) >= 1)
                    @foreach ($collection as $key => $item)    
                        <tr id="row{{$item->id}}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ number_format($item->width) }} x {{ number_format($item->length) }} mm</td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                <span class="{{ $item->status->label }}">
                                    {!! $item->status->icon !!} {{ $item->status->status }}
                                </span>
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSize(true, '{{$item->sheet_type_id}}', {{$item->status_id}}, '{{$item->width}}', '{{$item->length}}', '{{$item->remark}}', {{$item->id}}, {{ $key+1}})">
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
<div class="modal fade text-left" id="addRecordModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="recordForm">
                <div class="modal-header border-bottom">
                    <h3 class="modal-title"> Add New Size</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ft-x text-secondary"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-uppercase">Select Product Category</label>
                        <select class="form-control  border " name="sheet_type_id" id="sheet_type_id">
                            <option value="">- Select Category -</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id}}"> {{ $cat->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-6">
                            <label class="text-uppercase">Width</label>
                            <input id="width" name="width" class="form-control border px-50" type="text" placeholder="Enter width in inchs" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="text-uppercase">Length</label>
                            <input id="length" name="length" class="form-control border px-50" type="text" placeholder="Enter height in inchs" required>
                        </div>
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
                <div class="modal-footer border-top p-1">
                    <button type="button" id="submitButton" onclick="submitForm(false)" data-id="" class="btn btn-dark text-white m-0 px-2" data-rid=""> 
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
    
    function addSize(...values){
        isChange = null;
        const modal = $('#addRecordModal');

        if(values[0] == true){
            modal.find('.modal-title').text('Edit Size')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#recordForm input[name="status"]');

            modal.find('#sheet_type_id').val(values[1]);
            $.each(radioButtons, function(){
                if($(this).val() == values[2]){
                    $(this).prop('checked', true);
                }
            });
           
            modal.find('#width').val(values[3]);
            modal.find('#length').val(values[4]);
            modal.find('#remark').val(values[5]);
            modal.find('#submitButton').attr('data-id', values[6]);
            modal.find('#submitButton').attr('data-rid', values[7]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('recordForm');
            modal.find('.modal-title').text('Add New Size')
            modal.find('.modal-footer button .button-text').text('Add New')
            modal.find('#submitButton').attr('data-id', '');
            modal.find('#submitButton').attr('onclick', 'submitForm(false)');
            form.reset();
            modal.modal('show');
        }
    }

    function submitForm(editable){
        
        const sheet_type_id = $('#sheet_type_id').val();
        const length = $('#length').val();
        const width = $('#width').val();
        const remark = $('#remark').val();
        const status = $('input[name="status"]:checked').val();

        // Validations
        if(width == '') {
            toastr.clear()
            toastr.error('Width field is required');
            return false;
        }

        if(length == '') {
            toastr.clear()
            toastr.error('Length field is required');
            return false;
        }

        const formData = new FormData();

        formData.append('sheet_type_id', sheet_type_id);
        formData.append('length', length);
        formData.append('width', width);
        formData.append('remark', remark);
        formData.append('status', status);
        $("#add Modal").find('#submitButton').addClass('disable');
        $("#addRecordModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addRecordModal").find('#submitButton .spinner-border').addClass('show-spinner');
        
        if(editable == true){
            const HomePlanId = $("#submitButton").attr('data-id');
            const RowId = $("#submitButton").attr('data-rid');
            formData.append('id', HomePlanId);

            $.ajax({
                type: 'POST',
                url: siteURL+'/api/update/product-size/'+HomePlanId,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Product size has been updated successfully.');
                    let card = null;
                    card = `<td>${RowId}</td>
                            <td>
                                ${response.category.name}
                            </td>
                            <td>
                                ${response.width} x ${response.length} mm
                            </td>
                            <td>
                                ${response.remark}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSize(true, '${response.sheet_type_id}', '${response.status_id}', '${response.width}', '${response.length}', '${response.remark}', ${response.id}, '${RowId}')">
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
                url: siteURL+'/api/create/product-size',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Product size has been added successfully.');
                    let card = null;
                    card = `<tr id="row${response.id}">
                            <td>${RowId}</td>
                            <td>
                                ${response.category.name}
                            </td>
                            <td>
                                ${response.width} x ${response.length} mm
                            </td>
                            <td>
                                ${response.remark}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSize(true, '${response.sheet_type_id}', '${response.status_id}', '${response.width}', '${response.length}', '${response.remark}', ${response.id}, '${RowId}')">
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
            baseImage = input.files[0];
            isChange == 'view';
            
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
                deleteRecord(HomePlanId);
                Swal.fire(
                'Deleted!',
                'Product category has been deleted.',
                'success'
                )
            }
        })
    }

    
    function deleteRecord(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete/product-category',
            data: {id: id },
            success: function(){
                $(`#row${id}`).remove();
            }
        });
    }
</script>
@endpush