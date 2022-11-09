@extends('layouts.admin')
@section('content')
<div class="content-header d-flex flex-wrap bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Analytics</h3>
        <div class="breadcrumbs-top">
            <label class="switch mr-1">
                <input class="switch-input" type="checkbox" />
                <span class="switch-label" data-on="Google" data-off="Product"></span> 
                <span class="switch-handle"></span> 
            </label>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper py-0">
    <div class="content-body analytics">
        <div class="d-flex flex-column flex-md-row my-1">
            <div class="w-full pr-1">
                <select class="form-control px-1 py-25 m-0 border bg-white font-weight-medium" name="country" id="country">
                    <option value="">All Countries</option>
                </select>
            </div>
            <div class="w-full pr-1">
                <select class="form-control px-1 py-25 m-0 border bg-white font-weight-medium" name="state" id="state">
                    <option value="">All States</option>
                </select>
            </div>
            <div class="w-full pr-1">
                <select class="form-control px-1 py-25 m-0 border bg-white font-weight-medium" name="city" id="city">
                    <option value="">All Cities</option>
                </select>
            </div>
            <div class="w-full">
                <input type="text" name="daterange" class="form-control px-1 py-25 m-0 border bg-white font-weight-medium" />
            </div>
        </div>
        <div class="table-responsive bg-white analytics-tab">
            <nav>
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" id="nav-species-tab" data-toggle="tab" href="#nav-species" role="tab">Species</a>
                    <a class="nav-item nav-link" id="nav-cut-tab" data-toggle="tab" href="#nav-cut" role="tab">Slicing Technique</a>
                    <a class="nav-item nav-link" id="nav-quality-tab" data-toggle="tab" href="#nav-quality" role="tab">Quality</a>
                    <a class="nav-item nav-link" id="nav-matching-tab" data-toggle="tab" href="#nav-matching" role="tab">Matching</a>
                    <a class="nav-item nav-link" id="nav-type-tab" data-toggle="tab" href="#nav-type" role="tab">Product Category</a>
                    <a class="nav-item nav-link" id="nav-size-tab" data-toggle="tab" href="#nav-size" role="tab">Size</a>
                    <a class="nav-item nav-link" id="nav-substrate-tab" data-toggle="tab" href="#nav-substrate" role="tab">Panel Substrate</a>
                    <a class="nav-item nav-link" id="nav-thickness-tab" data-toggle="tab" href="#nav-thickness" role="tab">Panel Thickness</a>
                    <a class="nav-item nav-link" id="nav-backer-tab" data-toggle="tab" href="#nav-backer" role="tab">Backer</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-species" role="tabpanel" aria-labelledby="nav-species-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Species</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-cut" role="tabpanel" aria-labelledby="nav-cut-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="cut_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Slicing Technique</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="tab-pane fade" id="nav-quality" role="tabpanel" aria-labelledby="nav-quality-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="quality_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Quality</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="nav-matching" role="tabpanel" aria-labelledby="nav-matching-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="matching_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Matching</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-type" role="tabpanel" aria-labelledby="nav-type-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="type_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product Category</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-size" role="tabpanel" aria-labelledby="nav-size-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="size_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product Category</th>
                                            <th>Size</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="nav-substrate" role="tabpanel" aria-labelledby="nav-substrate-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="substrate_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Panel Substrate</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="nav-thickness" role="tabpanel" aria-labelledby="nav-thickness-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="thickness_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Panel Thickness</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-backer" role="tabpanel" aria-labelledby="nav-backer-tab">
                    <div class="row m-0">
                        <div class="col-xl-5">
                            <div id="backer_pie"></div>
                        </div>
                        <div class="col-xl-7 p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product Category</th>
                                            <th>Backer</th>
                                            <th>Selected Sessions</th>
                                            <th>Total Sessions</th>
                                            <th>Popularity</th>
                                        </tr>
                                    </thead>
                                    <tbody class='list_analytics'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/us/us-all.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/maps/modules/drilldown.js"></script>
<script type="text/javascript" src="{{ asset('backend/js/product-analytics.js') }}"></script>
@endpush