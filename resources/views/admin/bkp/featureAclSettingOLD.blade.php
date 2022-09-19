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
                    <li class="breadcrumb-item"><a href="{{route('floorplan-elevation', ['elevation_id' => base64_encode($feature->homefloorplan->elevation->home_id)])}}">Elevations</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('floorplanlist', ['elevation_id' => base64_encode($feature->homefloorplan->elevation->id)])}}">Floorplans</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('homeplan-features', ['elevation_id' => base64_encode($feature->homefloorplan->id)])}}">Feature</a>
                    </li>
                    <li class="breadcrumb-item"><u class="ml-25"> ACL Settings : {{ ucwords($feature->title) }}</u>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="{{route('homeplan-features', ['elevation_id' => base64_encode($feature->homefloorplan->id)])}}" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
            <i class="ft-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>
</div>
<div class="content-wrapper">
        @if(count($errors) > 0)
            <div class="alert alert-danger" id="msg">
                <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if(\Session::has('success'))
            <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong>Success!</strong> {{ \Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="table-responsive">
            
                <form method="POST" action="{{url('admin/save-acl-settings')}}" accept-charset="UTF-8" id="acl_setting_form" novalidate="novalidate">
                    @csrf
                    <input name="homeFloorplanid" type="hidden" value="{{$feature->homeFloorplan->id}}">
                    <table class="table table-bordered aclTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th>Options</th>
                                <th>Conflicts</th>
                                <th>Dependency</th>
                                <th>Togetherness</th>
                                <th class="delete_acl_row">Delete</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            <tr class="tr_clone" id="tr">
                                <td class="w-20" style="width: 20%;">
                                    <select class="form-control forms1 main_option js-example-basic-single" id="main_option" name="main_option" onchange="javascript:setOption(this.value)" readonly>
                                        <option value="0">Choose Option</option>
                                        <?php foreach ($features as $ky => $opt): ?>
                                            <option disabled 
                                            <?php if ($ky == $acl_setting['home_floor_feature_id']) 
                                            {?> selected <?php }?> 
                                            value="{{$ky}}">{{$opt}}</option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td class="w-20">
                                    @foreach($features as $ky => $feature)
                                        <div class="icheckbox_line-blue d-inline-block">
                                            <label id="conflictlabel-{{$ky}}" class="btn btn-outline-success options-container">
                                                <input class="option" id="conflict-{{$ky}}" type="checkbox" name="conflict[]" value="{{ $ky }}" style="display:none;" @click="setConflict({{$ky}})" />
                                                {{ ucfirst($feature) }}
                                            </label>
                                        </div>
                                    @endforeach                                    
                                </td>
                                <td class="w-20">
                                    @foreach($features as $ky => $feature)
                                        <div class="icheckbox_line-blue  d-inline-block">
                                            <label id="dependencylabel-{{$ky}}" class="btn btn-outline-success options-container">
                                                <input class="option" id="dependency-{{$ky}}" type="checkbox" name="dependency[]" value="{{ $ky }}" style="display:none;" @click="setDependency({{$ky}})"/>
                                                {{ ucfirst($feature) }}
                                            </label>
                                        </div>
                                    @endforeach                                    
                                </td>
                                <td class="w-20">
                                    @foreach($features as $ky => $feature)
                                        <div class="icheckbox_line-blue  d-inline-block">
                                            <label id="togethernesslabel-{{$ky}}" class="btn btn-outline-success options-container">
                                                <input class="option" id="togetherness-{{$ky}}" type="checkbox" name="togetherness[]" value="{{ $ky }}" style="display:none;" @click="setTogetherness({{$ky}})"/>
                                                {{ ucfirst($feature) }}
                                            </label>
                                        </div>
                                    @endforeach                                    
                                </td>
                                <td class="w-20 delete_acl_row">
                                    <a href="#" id="{{base64_encode($acl_setting->id)}}" class="delete_record_btn" onclick="resetAclSetting({{$acl_setting->id}})" data-toggle="modal" data-target="#modal-delete"><i class="la la-trash"></i> Reset</a>
                                </td>
                            </tr>                       
                    </tbody>
                    </table>
                    <div class="col-md-3 float-right saveACLBtn">
                    <button id="save_acl_btn" type="submit" class="float-right d-none d-sm-inline-block btn btn-success btn-min-width mb-1 waves-effect waves-light"><span class="fa fa-save">&nbsp;&nbsp;</span>Save</button>
                    </div>
                    <input id="acl_data_field" name="id" value="{{ $acl_setting->id }}" type="hidden">
                </form>
            </div>
        </div> 
    </div>
                                        </div>
@push('scripts')

@endpush
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        const features =  @json($features);
        const aclConflict = @json($conflicts);
        
        if(aclConflict && aclConflict.length > 0){
            for(const key in features){                
                if(aclConflict.indexOf(key) >= 0){
                    document.getElementById('conflict-'+key).checked = true;
                    document.getElementById('conflictlabel-'+key).className ='btn btn-success options-container';
                    document.getElementById('dependencylabel-'+key).style.display ='none'
                    document.getElementById('togethernesslabel-'+key).style.display ='none'
                }
            }
        }
        const aclDependency = @json($dependency);        
        if(aclDependency && aclDependency.length > 0){
            for(const key in features){                
                if(aclDependency.indexOf(key) >= 0){
                    document.getElementById('dependency-'+key).checked = true;
                    document.getElementById('dependencylabel-'+key).className ='btn btn-success options-container';
                    document.getElementById('conflictlabel-'+key).style.display ='none'
                    document.getElementById('togethernesslabel-'+key).style.display ='none'
                }
            }
        }
        const aclTogetherness = @json($togetherness);        
        if(aclTogetherness && aclTogetherness.length > 0){
            for(const key in features){                
                if(aclTogetherness.indexOf(key) >= 0){
                    document.getElementById('togetherness-'+key).checked = true;
                    document.getElementById('togethernesslabel-'+key).className ='btn btn-success options-container';
                    document.getElementById('conflictlabel-'+key).style.display ='none'
                    document.getElementById('dependencylabel-'+key).style.display ='none'
                }
            }
        }
        const options = ['conflict', 'dependency', 'togetherness'];
        const optionsLabel = ['conflictlabel', 'dependencylabel', 'togethernesslabel'];
    })
    function resetoptions(){
        //display all        //uncheck all        //undisabled all
        for(var i = 0; i<options.length; ++i){
            for(const key in features){
                $("#"+options[i]+'label-'+key).css('display', 'inline-block')
                $("#"+options[i]+'-'+key).prop('checked', false)
                $("#"+options[i]+'-'+key).removeAttr('disabled')
            }
        }
    }
    function setOption(val){
        resetoptions();
        for(const key in features){
            if(val == key){
                $('#conflictlabel-'+key).css('display', 'none')
                $('#dependencylabel-'+key).css('display', 'none')
                $('#togethernesslabel-'+key).css('display', 'none')                
            }else{
                $('#conflictlabel-'+key).css('display', 'inline-block')
                $('#dependencylabel-'+key).css('display', 'inline-block')
                $('#togethernesslabel-'+key).css('display', 'inline-block')
            }
            $('#conflictlabel-'+key).attr('class', 'btn btn-outline-success options-container')
            $('#dependencylabel-'+key).attr('class', 'btn btn-outline-success options-container')
            $('#togethernesslabel-'+key).attr('class', 'btn btn-outline-success options-container')
        }        
    }
    function setConflict(val){
        if($('#conflict-'+val).prop('checked') == true){
            
            $('#conflictlabel-'+val).attr('class', 'btn btn-success options-container')
            $('#dependency-'+val).prop('checked', false)
            $('#togetherness-'+val).prop('checked', false)
            //hide
            $('#dependencylabel-'+val).css('display', 'none')
            $('#togethernesslabel-'+val).css('display', 'none')
        } else {
            $('#conflictlabel-'+val).attr('class', 'btn btn-outline-success options-container')
            //show
            $('#dependencylabel-'+val).css('display', 'inline-block')
            $('#togethernesslabel-'+val).css('display', 'inline-block')
        }
    }
    function setDependency(val, rc){
        if($('#dependency-'+val).prop('checked') == true){
            $('#dependencylabel-'+val).attr('class', 'btn btn-success options-container')
            $('#conflict-'+val).prop('checked', false)
            $('#togetherness-'+val).prop('checked', false)
            //hide
            $('#conflictlabel-'+val).css('display', 'none')
            $('#togethernesslabel-'+val).css('display', 'none')
        } else {
            $('#dependencylabel-'+val).attr('class', 'btn btn-outline-success options-container')
            $('#conflictlabel-'+val).css('display', 'inline-block')
            $('#togethernesslabel-'+val).css('display', 'inline-block')
        }
    }
    function setTogetherness(val, rc){
        if($('#togetherness-'+val).prop('checked') == true){
            $('#togethernesslabel-'+val).attr('class', 'btn btn-success options-container')
            $('#conflict-'+val).prop('checked', false)
            $('#dependency-'+val).prop('checked', false)
            //hide
            $('#conflictlabel-'+val).css('display', 'none')
            $('#dependencylabel-'+val).css('display', 'none')
        } else {
            $('#togethernesslabel-'+val).attr('class', 'btn btn-outline-success options-container')
            $('#conflictlabel-'+val).css('display', 'inline-block')
            $('#dependencylabel-'+val).css('display', 'inline-block')
        }
    }
</script>
<style>
    .checked{
    }
    .options-container{
        margin-bottom: 5px;
        border-radius: 3px;
    }
    .options{
    }
</style>
@endsection