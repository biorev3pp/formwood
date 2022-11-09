@extends('layouts.admin')
@section('content')
<div class="content-header d-flex flex-wrap bg-white justify-content-between" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Inquiries</h3>
    </div>
    <div class="filter-form">
        <div class="d-flex">
            <label>Filter by Daterange: </label>
            <input type="text" name="daterange" class="form-control daterange border bg-white font-weight-medium" placeholder="Filter Inquiries" />
        </div>
    </div>
    <div class="content-header-right" style="position: relative; top:3px">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="javascript:;" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Download Excel
            </a>
          
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="javascript:;" onclick="downloadSelected()">Selected Records</a>
              <a class="dropdown-item" href="javascript:;" onclick="downloadExcel()">All Records</a>
            </div>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper pb-0">
    <div class="content-body">
        <div class="table-responsive bg-white fixed-header-table">
            <table class="table table-striped biorev-table">
                <thead>
                    <tr class="text-uppercase">
                        <th class="sno">SNo
                            <input type="checkbox" class="bulk_checkbox_all" name="allRecords" id="allRecords" value="1" />
                        </th>
                        <th>Name</th>
                        <th>Contacts</th>
                        <th>Address</th>
                        <th class="text-center">Product</th>
                        <th class="action-4">Date</th>
                        <th class="sno text-center px-1">#</th>
                    </tr>
                </thead>
                <tbody id="recordBody"></tbody>
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
                                    <option value="del">Delete Selected</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" id="bulk_action_btn" class="btn btn-primary">Apply Action</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="showing">Showing records</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="recordModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom py-1">
                <h3 class="modal-title">Inquiry Details</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ft-x text-secondary"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-dark text-center p-2">
                    <img src="{{ asset('backend/images/loader.gif') }}" alt="loading..." />
                </div>
                <h6 class="text-dark text-center">Please wait, we are getting all the details</h6>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    let filter_conditions_array = {'start_date': '','end_date':''};
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        filter_conditions_array["start_date"] = start.format('YYYY-MM-DD');
        filter_conditions_array["end_date"] = end.format('YYYY-MM-DD');
        start_date = start.format('YYYY-MM-DD');
        end_date = end.format('YYYY-MM-DD');
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-enquiries?sdate='+filter_conditions_array.start_date+'&edate='+filter_conditions_array.end_date,
            success: function(response){
               $('#recordBody').html(response)
            }
        });
    }

    $('input[name="daterange"]').daterangepicker({
        opens:'center',
        alwaysShowCalendars: true,
        locale: {
             format: 'DD MMM YYYY'
        },
        startDate: start,
        endDate: end,
        maxDate: new Date(),
        ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
    const path = "{{$MEDIA_URL.'attachments'}}";
    const host = "{{asset('backend/images')}}";
    function viewEstimate(est) {
        $('#recordModal').modal('show');
        $('.modal-body').html(`<div class="text-dark text-center p-2"><img src="${host}/loader.gif" alt="loading..." /></div><h6 class="text-dark text-center">Please wait, we are getting all the details</h6>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/view-estimate/'+est,
            success: function(response){
               $('.modal-body').html(response)
            }
        });
    }
    function deleteSwal(rid){
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
                deleteRecord(rid);
            }
        })
    }

    function downloadExcel(rid){
        toastr.info('Please wait, we are creating excel for you.');
        var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
                action: '/admin/export-inquiries'
            }).appendTo(document.body);
            
        $('<input type="hidden" />').attr({name: '_token', value: $('meta[name="csrf-token"]').attr('content')}).appendTo(f);
        $('<input type="hidden" />').attr({name: 'eids', value: rid}).appendTo(f);
        f.submit();
        f.remove();
    }

    function downloadSelected(){
        let blk_Records = [];
        $("input:checkbox[name=bulk_record_id]:checked").each(function(){
            blk_Records.push($(this).val());
        });
        if(blk_Records.length >= 1) {
            downloadExcel(blk_Records);
        } else {
            toastr.error('Please select at least 1 inquiry to export.');
        }
    }

    function deleteRecord(id){
        $.ajax({
            type: 'delete',
            url: '/api/delete/enquiry',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {id: id },
            success: function(){
                $(`#row${id}`).remove();
                toastr.info('Inquiry has been trashed successfully.');
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
                url: siteURL+'/api/bulk/enquiry',
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