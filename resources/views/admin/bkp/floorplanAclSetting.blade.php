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
                    <li class="breadcrumb-item"><a href="{{route('floorplan-elevation', ['elevation_id' => base64_encode($homeFloorplan->home->id)])}}">Elevations</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('floorplanlist', ['elevation_id' => base64_encode($homeFloorplan->elevation->id)])}}">Floorplans</a>
                    </li>
                    <li class="breadcrumb-item"><u class="ml-25"> ACL Settings : {{ ucwords($homeFloorplan->title) }}</u>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="{{route('floorplanlist', ['elevation_id' => base64_encode($homeFloorplan->elevation->id)])}}" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
            <i class="ft-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>
</div>
<div class="content-wrapper">
    <div class="clearfix"></div>
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
                    <input name="homeFloorplanid" type="hidden" value="{{$homeFloorplan->id}}">
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
                            @php $i=0; @endphp
                            @forelse($acl_settings as $acl)
                                <tr class="tr_clone" id="tr_{{$i}}">
                                    <td class="w-20" style="width: 20%;">
                                        <input class="form-control main_option forms1" id="new_main_option-{{$i}}" name="new_main_option[{{$i}}][]" type="hidden" value="{{$acl['home_floor_feature_id']}}">
                                        @if($acl['home_floor_feature_id'])
                                            <select class="form-control forms1 main_option js-example-basic-single" id="main_option{{$i}}" name="main_option[{{$i}}]" value="{{$acl['home_floor_feature_id']}}" onchange="javascript:setOption(this.value, {{ $i }})">
                                                <option >Choose Option</option>
                                                <?php $uFeatures = []; ?>
                                                <?php foreach ($features as $ky => $opt): ?>
                                                    <option 
                                                    <?php if($acl['home_floor_feature_id']) { ?> disabled <?php } ?>
                                                    <?php if ($ky == $acl['home_floor_feature_id']) 
                                                    {?> selected <?php }?> 
                                                    value="{{$ky}}">{{$opt}}</option>
                                                <?php endforeach;?>
                                            </select>
                                        @else
                                            <select class="form-control forms1 main_option js-example-basic-single" id="main_option{{$i}}" name="main_option[{{$i}}]" onchange="javascript:setOption(this.value, {{ $i }})">
                                                <option value="0">Choose Option</option>
                                                <?php $uFeatures = []; ?>                                                
                                                @foreach ($features as $ky => $opt)
                                                    @if(!in_array($ky, $aclSettingArr))
                                                        <?php $uFeatures[$ky] = $opt; ?>
                                                    @endif
                                                @endforeach
                                                <?php foreach ($uFeatures as $ky => $opt): ?>
                                                    <option 
                                                    value="{{$ky}}">{{$opt}}</option>
                                                <?php endforeach;?>
                                            </select>
                                        @endif
                                    </td>
                                    <td class="w-20">
                                        @foreach($features as $ky => $feature)                                        
                                            @if($acl['home_floor_feature_id'] != $ky)
                                                <div class="icheckbox_line-blue checked">
                                                    <label id="conflictlabel-{{$ky}}-{{$i}}" class="btn btn-outline-success options-container">
                                                        <input class="option" id="conflict-{{$ky}}-{{$i}}" type="checkbox" name="conflict[{{$i}}][]" value="{{ $ky }}" style="" @click="setConflict({{$ky}}, {{$i}})"/>
                                                        {{ ucfirst($feature) }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach                                    
                                    </td>
                                    <td class="w-20">
                                        @foreach($features as $ky => $feature)
                                            @if($acl['home_floor_feature_id'] != $ky)
                                                <div class="icheckbox_line-blue checked">
                                                    <label id="dependencylabel-{{$ky}}-{{$i}}" class="btn btn-outline-success options-container">
                                                        <input class="option" id="dependency-{{$ky}}-{{$i}}" type="checkbox" name="dependency[{{$i}}][]" value="{{ $ky }}" style="" @click="setDependency({{$ky}}, {{$i}})"/>
                                                        {{ ucfirst($feature) }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach                                    
                                    </td>
                                    <td class="w-20">
                                        @foreach($features as $ky => $feature)
                                            @if($acl['home_floor_feature_id'] != $ky)
                                                <div class="icheckbox_line-blue checked">
                                                    <label id="togethernesslabel-{{$ky}}-{{$i}}" class="btn btn-outline-success options-container">
                                                        <input class="option" id="togetherness-{{$ky}}-{{$i}}" type="checkbox" name="togetherness[{{$i}}][]" value="{{ $ky }}" style="" @click="setTogetherness({{$ky}}, {{$i}})"/>
                                                        {{ ucfirst($feature) }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach                                    
                                    </td>
                                    <td class="w-20 delete_acl_row">
                                        <button type="button" class="btn btn-danger btn-sm mb-1 waves-effect waves-light clonetrBtn" onclick="deleteData({{$acl['id']}})" data-toggle="modal" data-target="#modal-delete"><i class="la la-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @empty
                            @endforelse
                    </tbody>
                    </table>
                    <div class="col-md-3 float-left">
                    <a href="{{route('add-acl-setting', ['home_floorplan_id' => $homeFloorplan->id])}}" class="d-none d-sm-inline-block btn btn-info btn-min-width mb-1 waves-effect waves-light clonetrBtn"><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Row</a>
                    </div>
                    <div class="col-md-3 float-right saveACLBtn">
                    <button id="save_acl_btn" type="submit" class="float-right d-none d-sm-inline-block btn btn-success btn-min-width mb-1 waves-effect waves-light"><span class="fa fa-save">&nbsp;&nbsp;</span>Save</button>
                    </div>
                    <input id="acl_data_field" name="acl_data" type="hidden">
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
        const acl_settings = @json($acl_settings);
        for(var i = 0; i<acl_settings.length; ++i){
            if(acl_settings[i]['conflicts'] && JSON.parse(acl_settings[i]['conflicts']).length > 0){
                var c = JSON.parse(acl_settings[i]['conflicts'])
                for(var j = 0; j<c.length; ++j){
                    document.getElementById('conflict-'+c[j]+'-'+i).checked = true;
                    document.getElementById('conflictlabel-'+c[j]+'-'+i).className ='btn btn-success options-container';
                    document.getElementById('dependencylabel-'+c[j]+'-'+i).style.display ='none'
                    document.getElementById('togethernesslabel-'+c[j]+'-'+i).style.display ='none'
                }
            }
            if(acl_settings[i]['dependency'] && JSON.parse(acl_settings[i]['dependency']).length > 0){
                var c = JSON.parse(acl_settings[i]['dependency'])
                for(var j = 0; j<c.length; ++j){
                    document.getElementById('dependency-'+c[j]+'-'+i).checked = true;
                    document.getElementById('dependencylabel-'+c[j]+'-'+i).className ='btn btn-success options-container';
                    document.getElementById('conflictlabel-'+c[j]+'-'+i).style.display ='none'
                    document.getElementById('togethernesslabel-'+c[j]+'-'+i).style.display ='none'
                }
            }
            if(acl_settings[i]['togetherness'] && JSON.parse(acl_settings[i]['togetherness']).length > 0){
                var c = JSON.parse(acl_settings[i]['togetherness'])
                for(var j = 0; j<c.length; ++j){
                    document.getElementById('togetherness-'+c[j]+'-'+i).checked = true;
                    document.getElementById('togethernesslabel-'+c[j]+'-'+i).className ='btn btn-success options-container';
                    document.getElementById('conflictlabel-'+c[j]+'-'+i).style.display ='none'
                    document.getElementById('dependencylabel-'+c[j]+'-'+i).style.display ='none'
                }
            }
        }
    })
    
    const features =  @json($features);
    const options = ['conflict', 'dependency', 'togetherness'];
    const optionsLabel = ['conflictlabel', 'dependencylabel', 'togethernesslabel'];

    function resetoptions(rc){
        //display all        //uncheck all        //undisabled all
        for(var i = 0; i<options.length; ++i){
            for(const key in features){
                console.log("#"+options[i]+'-'+key+'-'+rc)
                console.log("#"+options[i]+'label-'+key+'-'+rc)
                $("#"+options[i]+'label-'+key+'-'+rc).css('display', 'inline-block')
                $("#"+options[i]+'-'+key+'-'+rc).prop('checked', false)
                $("#"+options[i]+'-'+key+'-'+rc).removeAttr('disabled')
            }
        }
    }
    function setOption(val, rc){
        $('#new_main_option-'+rc).val(val)
        resetoptions(rc);
        for(const key in features){
            if(val == key){
                $('#conflictlabel-'+key+'-'+rc).css('display', 'none')
                $('#dependencylabel-'+key+'-'+rc).css('display', 'none')
                $('#togethernesslabel-'+key+'-'+rc).css('display', 'none')                
            }else{
                $('#conflictlabel-'+key+'-'+rc).css('display', 'inline-block')
                $('#dependencylabel-'+key+'-'+rc).css('display', 'inline-block')
                $('#togethernesslabel-'+key+'-'+rc).css('display', 'inline-block')
            }
            $('#conflictlabel-'+key+'-'+rc).attr('class', 'btn btn-outline-success options-container')
            $('#dependencylabel-'+key+'-'+rc).attr('class', 'btn btn-outline-success options-container')
            $('#togethernesslabel-'+key+'-'+rc).attr('class', 'btn btn-outline-success options-container')
        }        
    }
    function setConflict(val, rc){
        if($('#conflict-'+val+'-'+rc).prop('checked') == true){
            
            $('#conflictlabel-'+val+'-'+rc).attr('class', 'btn btn-success options-container')
            $('#dependency-'+val+'-'+rc).prop('checked', false)
            $('#togetherness-'+val+'-'+rc).prop('checked', false)
            //hide
            $('#dependencylabel-'+val+'-'+rc).css('display', 'none')
            $('#togethernesslabel-'+val+'-'+rc).css('display', 'none')
        } else {
            $('#conflictlabel-'+val+'-'+rc).attr('class', 'btn btn-outline-success options-container')
            //show
            $('#dependencylabel-'+val+'-'+rc).css('display', 'inline-block')
            $('#togethernesslabel-'+val+'-'+rc).css('display', 'inline-block')
        }
    }
    function setDependency(val, rc){
        if($('#dependency-'+val+'-'+rc).prop('checked') == true){
            $('#dependencylabel-'+val+'-'+rc).attr('class', 'btn btn-success options-container')
            $('#conflict-'+val+'-'+rc).prop('checked', false)
            $('#togetherness-'+val+'-'+rc).prop('checked', false)
            //hide
            $('#conflictlabel-'+val+'-'+rc).css('display', 'none')
            $('#togethernesslabel-'+val+'-'+rc).css('display', 'none')
        } else {
            $('#dependencylabel-'+val+'-'+rc).attr('class', 'btn btn-outline-success options-container')
            $('#conflictlabel-'+val+'-'+rc).css('display', 'inline-block')
            $('#togethernesslabel-'+val+'-'+rc).css('display', 'inline-block')
        }
    }
    function setTogetherness(val, rc){
        if($('#togetherness-'+val+'-'+rc).prop('checked') == true){
            $('#togethernesslabel-'+val+'-'+rc).attr('class', 'btn btn-success options-container')
            $('#conflict-'+val+'-'+rc).prop('checked', false)
            $('#dependency-'+val+'-'+rc).prop('checked', false)
            //hide
            $('#conflictlabel-'+val+'-'+rc).css('display', 'none')
            $('#dependencylabel-'+val+'-'+rc).css('display', 'none')
        } else {
            $('#togethernesslabel-'+val+'-'+rc).attr('class', 'btn btn-outline-success options-container')
            $('#conflictlabel-'+val+'-'+rc).css('display', 'inline-block')
            $('#dependencylabel-'+val+'-'+rc).css('display', 'inline-block')
        }
    }
    function deleteData(id){
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
                $.ajax({
                    type: 'post',
                    url: '/api/delete-acl-settings',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id:id},
                    success: function(response){
                        
                        if(response == 1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Acl Setting deleted successfully',                                
                            })
                            setTimeout(location.reload(), 10000)                            
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Please try again',                                
                            })
                        }
                    }
                });
            }
        })
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