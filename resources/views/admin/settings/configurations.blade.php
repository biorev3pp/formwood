@extends('layouts.admin') 
@section('content')
<div class="content-header d-flex flex-wrap bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Configurations</h3>
    </div>
</div>
<div class="content-wrapper">
    <form class="number-tab-steps wizard-notification wizard clearfix" id="custom_fonts_1" method="POST" action="{{route('update-settings')}}" enctype="multipart/form-data">
        @csrf
        <div class="steps clearfix">
            <ul role="tablist">
                <li role="tab" class="first" :class="[(activestep == 1)?'current':'done']" aria-disabled="false" aria-selected="true">
                    <a id="steps-uid-0-t-0" aria-controls="steps-uid-0-p-0">
                        <span class="current-info audible">current step: </span><span class="step">1</span> Basic Information
                    </a>
                </li>
                <li role="tab" :class="[((activestep == 1) && (donestep == 0))?'disabled':(activestep == 2)?'current':'done']" aria-disabled="false" aria-selected="false">
                    <a id="steps-uid-0-t-1" aria-controls="steps-uid-0-p-1">
                        <span class="step">2</span> Module Selection
                    </a>
                </li>
                <li role="tab" :class="[((activestep <= 2) && (donestep <= 1))?'disabled':(activestep == 3)?'current':'done']" aria-disabled="true">
                    <a id="steps-uid-0-t-2" aria-controls="steps-uid-0-p-2">
                        <span class="step">3</span> Finished
                    </a>
                </li>
            </ul>
            
        </div>   
        <div class="content clearfix py-2">
            <h6 id="steps-uid-3-h-0" tabindex="-1" class="title current">Step 1</h6>
            <fieldset id="steps-uid-3-p-0" role="tabpanel" aria-labelledby="steps-uid-3-h-0" class="body current" aria-hidden="false" v-show="activestep == 1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName3">
                                Company Name:
                                <span class="danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="firstName3" name="firstName" aria-invalid="true">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName3">
                                Handler Name :
                                <span class="danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="lastName3" name="lastName">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress5">
                                Email Address :
                                <span class="danger">*</span>
                            </label>
                            <input type="email" class="form-control required" id="emailAddress5" name="emailAddress">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress5">
                                Contact No :
                                <span class="danger">*</span>
                            </label>
                            <input type="email" class="form-control required" id="emailAddress5" name="emailAddress">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress5">
                                Address :
                                <span class="danger">*</span>
                            </label>
                            <input type="email" class="form-control required" id="emailAddress5" name="emailAddress">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress5">
                                Zipcode:
                                <span class="danger">*</span>
                            </label>
                            <input type="email" class="form-control required" id="emailAddress5" name="emailAddress">
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Step 2 -->
            <h6 id="steps-uid-3-h-1" tabindex="-1" class="title">Step 2</h6>
            <fieldset id="steps-uid-3-p-1" role="tabpanel" aria-labelledby="steps-uid-3-h-1" class="body" aria-hidden="true" v-show="activestep == 2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="proposalTitle3">
                                Select Modules You are interested in...
                                <span class="danger">*</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="c-inputs-stacked">
                                <div class="d-inline-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing1" value="1">
                                    <label class="custom-control-label" for="staffing1">Community</label>
                                </div>
                                <div class="d-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing2" value="2">
                                    <label class="custom-control-label" for="staffing2">Xplat</label>
                                </div>
                                <div class="d-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing3" value="3">
                                    <label class="custom-control-label" for="staffing3">Xhome</label>
                                </div>
                                <div class="d-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing4" value="4">
                                    <label class="custom-control-label" for="staffing4">Xfloor</label>
                                </div>
                                <div class="d-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing5" value="5">
                                    <label class="custom-control-label" for="staffing5">Xdesign</label>
                                </div>
                                <div class="d-block custom-control custom-checkbox">
                                    <input type="checkbox" name="status3" class="custom-control-input" id="staffing6" value="6">
                                    <label class="custom-control-label" for="staffing6">Mortgage</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border-left">
                        <p><b>Community</b><br> Manage Communities with google location and related information.</p>
                        <p><b>Plat</b><br> Homesite with available elevations and status.</p>
                        <p><b>Home</b><br> Exterior Customization and home upgrade features.</p>
                        <p><b>Floor</b><br> Floor feature modifications and management.</p>
                        <p><b>Design</b><br> Manage and Customize Home Interior.</p>
                        <p><b>Mortgage</b><br> Payment calculation with Interest rate customization.</p>
                    </div>
                </div>
            </fieldset>

            <!-- Step 3 -->
            <h6 id="steps-uid-3-h-2" tabindex="-1" class="title">Step 3</h6>
            <fieldset id="steps-uid-3-p-2" role="tabpanel" aria-labelledby="steps-uid-3-h-2" class="body" aria-hidden="true" v-show="activestep == 3">
                <p class="m-1">You have selected Following Modules: 
                    <span class="badge badge-striped border-left-blue">
                        <a href="#">Xplat</a>
                    </span>
                    <span class="badge badge-striped border-left-blue">
                        <a href="#">Mortgage</a>
                    </span>
                </p>
                <p class="m-1">By clicking Submit, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a>.
                </p>
            </fieldset>
        </div>
        <div class="actions clearfix">
            <ul role="menu" aria-label="Pagination">
                <li class="disabled" aria-disabled="true">
                    <button type="button" class="btn btn-default mw-150" v-if="activestep == 1" disabled role="menuitem">Previous</button>
                    <button type="button" class="btn btn-default mw-150" v-else @click="GoPrevious" role="menuitem">Previous</button>
                </li>
                <li aria-hidden="false" aria-disabled="false" v-show="activestep < 3">
                    <button type="button" class="btn btn-primary mw-150" @click="GoNext" role="menuitem">Next</button>
                </li>
                <li aria-hidden="true" v-show="activestep == 3">
                    <button type="submit" class="btn btn-dark mw-150">Submit</button>
                </li>
            </ul>
        </div>
    </form>

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
@endsection