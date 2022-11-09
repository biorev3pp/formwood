@extends('layouts.admin') 
@section('content')
<div class="content-header d-flex flex-wrap bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Configurations</h3>
    </div>
</div>
<div class="content-wrapper">
    <div class="content-body">
        <section id="page-account-settings">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-12 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                        @for ($i = 1; $i <= 8; $i++)
                            <li class="nav-item">
                                <a class="nav-link d-flex waves-effect waves-dark text-uppercase bg-white {{ ($i == 1)?'active':'' }} mb-25" id="step-{{$i}}" data-toggle="pill" href="#content-step-{{$i}}" aria-expanded="true">
                                    <i class="ft-file-text mr-50"></i>
                                    STEP {{ $i }}
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-10 col-sm-9 col-12">
                    <div class="card m-0">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content full-page">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <div role="tabpanel " class="tab-pane {{ ($i == 1)?'active show':'' }}" id="content-step-{{$i}}" aria-expanded=" {{ ($i == 1)?'true':'false' }}">
                                            <form class="col-sm-12" method="POST" action="{{route('update-settings')}}"  enctype="multipart/form-data">
                                            @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        @foreach($settings as $key => $value)
                                                            @if($value->section == $i+1)
                                                                @if($value->type =='file')
                                                                    <div class="row m-0">
                                                                        <a href="javascript: void(0);" id="imgstep_{{$value->name}}">
                                                                            @if($value->value)
                                                                                <img src="{{asset('media/'.$value->value)}}" class="rounded mr-75" alt="profile image" style="height:98px">
                                                                            @else
                                                                                <img src="{{asset('images/placeholder.jpg')}}" class="rounded mr-2" alt="image" style="height:98px">
                                                                            @endif
                                                                        </a>
                                                                        <div class="media-body mt-75 d-flex">
                                                                            <div class="">
                                                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light" for="account_upload_{{$value->name}}">Upload {{ str_replace('_', ' ', $value->name) }}</label>
                                                                                <input type="file" id="account_upload_{{$value->name}}" hidden="" name="{{ $value->name }}">
                                                                                <p class="ml-75 mt-50">
                                                                                    <small class="font-weight-bold text-danger">Allowed JPG, GIF or PNG.<br> Max size of 800kB</small>
                                                                                </p>
                                                                            </div>
                                                                            <div class="">
                                                                                @if($value->value)
                                                                                    <button type="button" class="btn btn-sm btn-dark  ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light" onclick="removeImage('{{ $value->name }}')" id="rmbbtn{{ $value->name }}">Remove Image</button>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @elseif($value->type =='textarea')
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="name" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>
                                                                        <textarea class="form-control" id="{{ $value->name }}" name="{{ $value->name }}" rows="3" placeholder="Enter {{ str_replace('_', ' ', $value->name) }}">{{ $value->value }}</textarea>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="form-group">
                                                                    <label for="name" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>
                                                                    <input class="form-control" placeholder="Enter {{ str_replace('_', ' ', $value->name) }}" id="{{ $value->name }}" name="{{ $value->name }}" type="{{ $value->type }}" value="{{ $value->value }}">
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-dark mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">Submit Details</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php if(\Session::has('success')): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        toastr.success("<?= Session::get('success') ?>");
    </script>
<?php endif; ?>
<?php if(\Session::has('error')): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        toastr.success("<?= Session::get('error') ?>");
    </script>
<?php endif; ?>
<script>
    function removeImage(p) {
        const formData = new FormData();
        formData.append('field', p);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: siteURL+'/api/reset-image',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            data: formData,
            success: function (data) {
                toastr.success("Image has been removed successfully.");
                $('#imgstep_'+p).html(`<img src="{{asset('images/placeholder.jpg')}}" class="rounded mr-2" alt="image" style="height:98px">`);
                $('#rmbbtn'+p).hide();
            },
        });
    }
</script>
@endsection