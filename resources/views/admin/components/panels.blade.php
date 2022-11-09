<div>
    <div class="table-responsive bg-white fixed-header-table">
        <table class="table table-striped biorev-table">
            <thead>
                <tr class="text-uppercase">
                    <th class="sno">SNo
                        <input type="checkbox" class="bulk_checkbox_all" name="allRecords" id="allRecords" value="1" />
                    </th>
                    <th>Substrate</th>
                    <th class="action-3">Status</th>
                    <th class="action-3">
                        <button class="icon-btn" type="button" onclick="addSubstrate(false)">
                            <i class="ft-plus-square text-primary"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="recordBody">
                @if(count($collection) >= 1)
                    @foreach ($collection as $key => $item)    
                        <tr id="row{{$item->id}}">
                            <td>{{ $key+1 }}. <input type="checkbox" class="bulk_checkbox" id="record{{$item->id}}" value="{{$item->id}}" name="bulk_record_id" /></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="{{ $item->status->label }}">
                                    {!! $item->status->icon !!} {{ $item->status->status }}
                                </span>
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSubstrate(true, {{$item->status_id}}, '{{$item->name}}', {{$item->id}}, {{ $key+1}})">
                                    <i class="ft-edit"></i>
                                </a>
                                <a class="table-icon-btn text-danger" href="javascript:void(0);" onclick="deleteSwal({{$item->id}})">
                                    <i class="ft-trash-2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="nodata"> 
                        <td colspan="6">
                            <p class="text-danger p-0 m-0">
                                No items found in collection.
                            </p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="footer-actions">
            <div class="row m-0">
                <div class="col-md-2 select-counter">
                    <h6>Bulk Action</h6>
                    <span> 0 Records selected </span>
                </div>
                <div class="col-md-7">
                    <div id="bulk-action-form" class="d-none bulk-action-form">
                        <div class="form-group">
                            <select class="form-control border" name="bulk_action_type" id="bulk_action_type">
                                <option value="">Select Bulk Action</option>
                                <option value="stats">Change Status</option>
                                <option value="del">Delete Selected</option>
                            </select>
                        </div>
                        <div class="form-group d-none status-options">
                            <select class="form-control border" name="bulk_status" id="bulk_status">
                                <option value="">Select Status</option>
                                <option value="publish">Publish</option>
                                <option value="unpublish">Unpublish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" id="bulk_action_btn" class="btn btn-primary">Update All</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <p class="showing">Showing {{ count($collection) }} records</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="addRecordModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="recordForm">
                <div class="modal-header border-bottom">
                    <h3 class="modal-title"> Add New Substrate</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ft-x text-secondary"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-uppercase">Substrate Name</label>
                        <input id="name" name="name" class="form-control border px-50" type="text" placeholder="Enter name" required>
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
    const path = "{{$MEDIA_URL.'components'}}";
    const date = new Date();
    
    function addSubstrate(...values){
        isChange = null;
        const modal = $('#addRecordModal');

        if(values[0] == true){
            modal.find('.modal-title').text('Edit Substrate')
            modal.find('.modal-footer button .button-text').text('Save Changes')
            const radioButtons = $('#recordForm input[name="status"]');

            $.each(radioButtons, function(){
                if($(this).val() == values[1]){
                    $(this).prop('checked', true);
                }
            });
           
            modal.find('#name').val(values[2]);
            modal.find('#submitButton').attr('data-id', values[3]);
            modal.find('#submitButton').attr('data-rid', values[4]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('recordForm');
            modal.find('.modal-title').text('Add New Substrate')
            modal.find('.modal-footer button .button-text').text('Add New')
            modal.find('#submitButton').attr('data-id', '');
            modal.find('#submitButton').attr('onclick', 'submitForm(false)');
            form.reset();
            modal.modal('show');
        }
    }

    function submitForm(editable){
        
        const name = $('#name').val();
        const status = $('input[name="status"]:checked').val();

        // Validations
        if(name == '') {
            toastr.clear()
            toastr.error('Name is required');
            return false;
        }

        const formData = new FormData();

        formData.append('name', name);
        formData.append('status', status);
        $("#add Modal").find('#submitButton').addClass('disable');
        $("#addRecordModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addRecordModal").find('#submitButton .spinner-border').addClass('show-spinner');
        
        if(editable == true){
            const MainId = $("#submitButton").attr('data-id');
            const RowId = $("#submitButton").attr('data-rid');
            formData.append('id', MainId);

            $.ajax({
                type: 'POST',
                url: siteURL+'/api/update/substrate/'+MainId,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Substrate has been updated successfully.');
                    let card = null;
                    card = `<td>${RowId}. <input type="checkbox" class="bulk_checkbox" id="record${response.id}" value="${response.id}" name="bulk_record_id" /></td>
                            <td>
                                ${response.name}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSubstrate(true, '${response.status_id}', '${response.name}', ${response.id}, '${RowId}')">
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
            $('.nodata').remove();
            let RowId = $('#recordBody').children().length+1;
            $.ajax({
                type: 'POST',
                url: siteURL+'/api/create/substrate',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Substrate has been added successfully.');
                    let card = null;
                    card = `<tr id="row${response.id}">
                            <td>${RowId}. <input type="checkbox" class="bulk_checkbox" id="record${response.id}" value="${response.id}" name="bulk_record_id" /></td>
                            <td>
                                ${response.name}
                            </td>
                            <td>
                                ${(response.status_id == 1)?'<span class="badge fw-500 bg-info"><i class="ft-check mr-25"></i> Publish</span>':'<span class="badge fw-500 bg-danger"><i class="ft-x mr-25"></i> Unpublish</span>'}
                            </td>
                            <td>
                                <a class="table-icon-btn text-warning" href="javascript:void(0);" onclick="addSubstrate(true, '${response.status_id}', '${response.name}', ${response.id}, '${RowId}')">
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

    function deleteSwal(MainId){
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
                deleteRecord(MainId);
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
            url: '/api/delete/substrate',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {id: id },
            success: function(){
                $(`#row${id}`).remove();
            }
        });
    }
    $(document).ready(function(){
        $('#allRecords').on('click',function(){
            
            if(this.checked){
                $('.bulk_checkbox').each(function(){
                    this.checked = true;
                });
                $('.select-counter span').html($('.bulk_checkbox:checked').length+' records selected');
                $('#bulk-action-form').addClass('d-flex').removeClass('d-none');
            }else{
                $('.bulk_checkbox').each(function(){
                    this.checked = false;
                });
                $('.select-counter span').html('0 records selected');
                $('#bulk-action-form').removeClass('d-flex').addClass('d-none');
            }
        });
        
        $('.bulk_checkbox').on('click',function(){
            if($('.bulk_checkbox:checked').length == $('.bulk_checkbox').length){
                $('#allRecords').prop('checked',true);
            }else{
                $('#allRecords').prop('checked',false);
            }
            $('.select-counter span').html($('.bulk_checkbox:checked').length+' records selected');
            if($('.bulk_checkbox:checked').length >= 1) {
                $('#bulk-action-form').addClass('d-flex').removeClass('d-none');
            } else {
                $('#bulk-action-form').removeClass('d-flex').addClass('d-none');
            }
        });

        $('#bulk_action_type').on('change', function() {
            if($(this).val() == 'stats') {
                $('.status-options').removeClass('d-none')
            } else {
                $('.status-options').addClass('d-none')
            }
        })
        $('#bulk_action_btn').on('click', function(){
            const bulk_action_type = $('#bulk_action_type').val();
            const bulk_status = $('#bulk_status').val();
            if(bulk_action_type == '') {
                
                toastr.error('Please select your bulk action type to update.');
                return false;
            }
            const formData = new FormData();

            formData.append('bulk_action_type', bulk_action_type);
            formData.append('bulk_status', bulk_status);

            let blk_Records = [];
            $("input:checkbox[name=bulk_record_id]:checked").each(function(){
                blk_Records.push($(this).val());
            });
            formData.append('bulk_records', blk_Records);

            $.ajax({
                type: 'POST',
                url: siteURL+'/api/bulk/substrate',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    toastr.info('Bulk action applied successfully.');
                    location.reload();
                }
            });
        })
    });
</script>
@endpush