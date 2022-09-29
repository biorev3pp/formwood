@extends('layouts.admin')
@section('content')
<div class="content-header bg-white p-0">
    <div class="logic-header">
        <div>Species </div>
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
            <p class="text-info w-100 p-1 text-center">Data will load in a while</p>
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
    getCategorySize();
    function selectSpecie(sid) {
        $('.step1_list').removeClass('active');
        $('#step1_'+sid).addClass('active');
        $('.logic-section-2').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $('.logic-section-4').html(`<p class="text-info w-100 p-1 text-center">Please select checked cut to view options</p>`);
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

    function toggleAllMatchings() {
        if($('input:checkbox[name=allMatchingIds]').is(':checked')) {
            $("input:checkbox[name=matchingIds]").prop("checked", true);
        } else {
            $("input:checkbox[name=matchingIds]").prop("checked", false);
        } 
    }

    function toggleMatchings() {
        if($("input:checkbox[name=matchingIds]").length == $("input:checkbox[name=matchingIds]:checked").length) 
        { 
            $("input:checkbox[name=allMatchingIds]").prop("checked", true);
        }
        else {
            $("input:checkbox[name=allMatchingIds]").prop("checked", false);            
        }
    }

    function updateMatchings(val) {
        let matching_ids = [];
        $("input:checkbox[name=matchingIds]:checked").each(function(){
            matching_ids.push($(this).val());
        });
        const formData = new FormData();
        formData.append('matching_ids', matching_ids);
        formData.append('cut_id', val);
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-cut-matchings',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Cuts and Matching relation has been Updated Successfully.");
            }
        });
    }

    function getCategorySize() {
        $('.logic-section-5').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-category-sizes',
            processData: false,
            contentType: false,
            success: function(response){
                $('.logic-section-5').html(response);
            }
        });
    }

    function selectSize(stid, sid) {
        $('.step5_list').removeClass('active');
        $('#step5_'+sid).addClass('active');
        getBackers(sid);
        if(stid != 1) {
            $('.logic-section-6').html(`<p class="text-info w-100 p-1 text-center">This option is not available for this product category</p>`);
        } else {
            $('.logic-section-6').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
            $.ajax({
                type: 'GET',
                url: siteURL+'/api/get-panel-options',
                processData: false,
                contentType: false,
                success: function(response){
                    $('.logic-section-6').html(response);
                }
            });
        }
    }

    function selectSubstrate(sid = null) {
        $('.step6_list').removeClass('active');
        $('#step6_'+sid).addClass('active');
        $('.logic-subsection-6').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
            type: 'GET',
            url: siteURL+'/api/get-core-thickness/'+sid,
            processData: false,
            contentType: false,
            success: function(response){
                $('.logic-subsection-6').html(response);
            }
        });
    }

    function toggleAllThicknesss() {
        if($('input:checkbox[name=allThicknessIds]').is(':checked')) {
            $("input:checkbox[name=thicknessIds]").prop("checked", true);
        } else {
            $("input:checkbox[name=thicknessIds]").prop("checked", false);
        } 
    }

    function toggleThicknesss() {
        if($("input:checkbox[name=thicknessIds]").length == $("input:checkbox[name=thicknessIds]:checked").length) 
        { 
            $("input:checkbox[name=allThicknessIds]").prop("checked", true);
        }
        else {
            $("input:checkbox[name=allThicknessIds]").prop("checked", false);            
        }
    }

    function updateThickness(val) {
        let thickness_ids = [];
        $("input:checkbox[name=thicknessIds]:checked").each(function(){
            thickness_ids.push($(this).val());
        });
        const formData = new FormData();
        formData.append('thickness_ids', thickness_ids);
        formData.append('substrate_id', val);
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-panel-thickness',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Panel Substrate and Core Thickness relation has been Updated Successfully.");
            }
        });
    }

    function getBackers(sid) {
        $('.logic-section-7').html(`<p class="loader"><img src="{{asset('backend/images/loader.gif')}}" /></p>`);
        $.ajax({
                type: 'GET',
                url: siteURL+'/api/get-backers/'+sid,
                processData: false,
                contentType: false,
                success: function(response){
                    $('.logic-section-7').html(response);
                }
            });
    }

    function toggleAllBackers() {
        if($('input:checkbox[name=allBackerIds]').is(':checked')) {
            $("input:checkbox[name=backerIds]").prop("checked", true);
        } else {
            $("input:checkbox[name=backerIds]").prop("checked", false);
        } 
    }

    function toggleBackers() {
        if($("input:checkbox[name=backerIds]").length == $("input:checkbox[name=backerIds]:checked").length) 
        { 
            $("input:checkbox[name=allBackerIds]").prop("checked", true);
        }
        else {
            $("input:checkbox[name=allBackerIds]").prop("checked", false);            
        }
    }

    function updateBackers(val) {
        let backers = [];
        $("input:checkbox[name=backerIds]:checked").each(function(){
            backers.push($(this).val());
        });
        const formData = new FormData();
        formData.append('backer_ids', backers);
        formData.append('size_id', val);
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-size-backers',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Category Size and Backers relation has been Updated Successfully.");
            }
        });
    }

</script>
@endpush