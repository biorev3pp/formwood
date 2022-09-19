@extends('layouts.admin')
@section('content')
<div class="content-header d-flex flex-wrap bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Dashboard</h3>
        <div class="row breadcrumbs-top">
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper row">
    <div class="content-body col-lg-3 col-md-6 mb-1">
        <div class="card-content">
            <a href="#">
                <div class="card-body" style="background: #fff;box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);">
                    <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 style="color:#464855">105</h3>
                                <h6 style="font-size: 1.2rem;">Unique Customers</h6>
                            </div>
                            <div>
                                <i class="ft-clipboard" style="font-size:3rem;"></i>
                            </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="content-body col-lg-3 col-md-6 mb-1">
        <div class="card-content">
            <a href="#">
                <div class="card-body" style="background: #fff;box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);">
                    <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 style="color:#464855">105</h3>
                                <h6 style="font-size: 1.2rem;">Total Estimates</h6>
                            </div>
                            <div>
                                <i class="ft-clipboard" style="font-size:3rem;"></i>
                            </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
