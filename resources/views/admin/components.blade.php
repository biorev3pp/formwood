@extends('layouts.admin')
@section('content')
<div class="content-header d-flex flex-wrap bg-white pt-1 pb-50 px-1">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'product-categories')?'active':'' }}" href="{{ route('product-categories') }}">Product Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'sizes')?'active':'' }}" href="{{ route('sizes') }}">Sizes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'cuts')?'active':'' }}" href="{{ route('cuts') }}">Cuts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'quality')?'active':'' }}" href="{{ route('quality') }}">Quality</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'species')?'active':'' }}" href="{{ route('species') }}">Species</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'matchings')?'active':'' }}" href="{{ route('matchings') }}">Matching</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'panel-options')?'active':'' }}" href="{{ route('panel_options') }}">Panel Options</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($nav == 'backers')?'active':'' }}" href="{{ route('backers') }}">Backer</a>
        </li>
    </ul>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper p-0 border-top">
    <div class="tab-content all-components">
        <div role="tabpanel" class="tab-pane active">
            @if($nav == 'product-categories')
                @include('admin.components.product-categories')
            @elseif($nav == 'species')
                @include('admin.components.species')
            @elseif($nav == 'cuts')
                @include('admin.components.cuts')
            @elseif($nav == 'quality')
                @include('admin.components.quality')
            @elseif($nav == 'matchings')
                @include('admin.components.matching')
            @elseif($nav == 'sizes')
                @include('admin.components.sizes')
            @elseif($nav == 'panel-options')
                @include('admin.components.panels')
            @elseif($nav == 'backers')
                @include('admin.components.backers')
            @else
                <p class="alert alert-danger">
                    Please select one of the options from above menu
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
