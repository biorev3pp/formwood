@extends('layouts.admin')
@section('content')
<div class="content-header bg-white p-0">
    <div class="logic-header">
        <div>Species ({{ count($species) }}) </div>
        <div>Cuts</div>
        <div>Quality</div>
        <div>Matching</div>
        <div>Category/Size</div>
        <div>Panel Options</div>
        <div>Backers</div>
    </div>
</div>
<div class="content-wrapper p-0 border-top">
   <div class="logic-body bg-white">
        <div class="logic-section logic-section-1">
            <ul class="step1ul">
                @foreach ($species as $k => $i)
                    <li class="step1_list" id="step1_{{$i->id}}">
                        <a href="javascript:;" onclick="selectSpecie({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="logic-section logic-section-2">
            <p class="text-info w-100 p-1 text-center">Please select species to view options</p>
        </div>
        <div class="logic-section logic-section-3">
            <p class="text-info w-100 p-1 text-center">Please select species to view options</p>
        </div>
        <div class="logic-section logic-section-4">
            <p class="text-info w-100 p-1 text-center">Please select checked cut to view options</p>
        </div>
        <div class="logic-section logic-section-5">
            <p class="text-info w-100 p-1 text-center">Please select checked matching to view options</p>
        </div>
        <div class="logic-section logic-section-6">
            <p class="text-info w-100 p-1 text-center">Please select checked category/size to view options</p>
        </div>
        <div class="logic-section logic-section-7">
            <p class="text-info w-100 p-1 text-center">Please select checked panel options to view options</p>
        </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
    function selectSpecie(sid) {
        $('.step1_list').removeClass('active');
        $('#step1_'+sid).addClass('active');
        $('.logic-section-2').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-cuts/'+sid,
            processData: false,
            contentType: false,
            success: function(response){
                $('.logic-section-2').html(response);
            }
        });
        selectQuality(sid);
    }
    function updateCuts(val) {
        let cuts = [];
        $("input:checkbox[name=cutIds]:checked").each(function(){
            cuts.push($(this).val());
        });
        const formData = new FormData();
        formData.append('cut_ids', cuts);
        formData.append('species_id', val);
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-species-cuts',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Species and cuts relation has been Updated Successfully");
            }
        });
    }

    function updateQualities(val) {
        let cuts = [];
        $("input:checkbox[name=qualityIds]:checked").each(function(){
            cuts.push($(this).val());
        });
        const formData = new FormData();
        formData.append('quality_ids', cuts);
        formData.append('species_id', val);
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-species-qualities',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Species and qualities relation has been Updated Successfully");
            }
        });
    }

    function toggleAllCuts() {
        if($('input:checkbox[name=allCutIds]').is(':checked')) {
            $("input:checkbox[name=cutIds]").prop("checked", true);
        } else {
            $("input:checkbox[name=cutIds]").prop("checked", false);
        } 
    }

    function toggleCuts() {
        if($("input:checkbox[name=cutIds]").length == $("input:checkbox[name=cutIds]:checked").length) 
        { 
            $("input:checkbox[name=allCutIds]").prop("checked", true);
        }
        else {
            $("input:checkbox[name=allCutIds]").prop("checked", false);            
        }
    }

    function toggleAllQualities() {
        if($('input:checkbox[name=allQualityIds]').is(':checked')) {
            $("input:checkbox[name=qualityIds]").prop("checked", true);
        } else {
            $("input:checkbox[name=qualityIds]").prop("checked", false);
        } 
    }

    function toggleQualities() {
        if($("input:checkbox[name=qualityIds]").length == $("input:checkbox[name=qualityIds]:checked").length) 
        { 
            $("input:checkbox[name=allQualityIds]").prop("checked", true);
        }
        else {
            $("input:checkbox[name=allQualityIds]").prop("checked", false);            
        }
    }

    function selectQuality(cid = null) {
        $('.step2_list').removeClass('active');
        $('#step2_'+cid).addClass('active');
        $('.logic-section-3').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-qualities/'+cid,
            processData: false,
            contentType: false,
            success: function(response){
                $('.logic-section-3').html(response);
            }
        });
    }

    function selectMatching(cid = null) {
        $('.step2_list').removeClass('active');
        $('#step2_'+cid).addClass('active');
        $('.logic-section-4').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-matchings/'+cid,
            processData: false,
            contentType: false,
            success: function(response){
                $('.logic-section-4').html(response);
            }
        });
    }

</script>
@endpush