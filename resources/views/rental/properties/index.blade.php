@extends('layouts.rental.master')

@section('title', 'Properties')

@section('breadcrumb')
    <li class="active">Properties</li>
@endsection

@section('page-header')
    Properties
    <small>({{ isset($sort) ? title_case($sort) : 'All' }})</small>
    <div class="pull-right">
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                <strong class="text-right">
                    Actions
                    <span class="caret"></span>
                </strong>
            </button>
            <ul class="dropdown-menu pull-right">
                <li class="dropdown-header">Switch layout to</li>
                <li>
                    <a href="{{ route('rental.properties.index', ['id' => $app->id, 'sort' => 'all', 'layout' => 'grid']) }}">
                        <i class="glyphicon glyphicon-th-large"></i>
                        Grid View
                    </a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.index', ['id' => $app->id, 'sort' => 'all']) }}">
                        <i class="fa fa-list"></i>
                        List View
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Sort by</li>
                @if($layout != null)
                    @include('rental.properties.partials.menu_grid')
                @else
                    @include('rental.properties.partials.menu_default')
                @endif
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div id="properties-wrapper">
        @if(count($properties) > 0)
            @if($layout == null)
                @include('rental.properties.partials.default')
            @else
                @include('rental.properties.partials.grid')
            @endif
            <hr>
            <p class="label label-default">
                Properties ({{ isset($sort) ? title_case($sort) : 'All' }}) : {{ $properties->total() }}
            </p>
            <div class="clearfix">
                {{ $properties->links() }}
            </div>
        @else
            <p class="lead">No {{ isset($sort) ? title_case($sort) . ' ' : ' ' }}properties found.</p>
        @endif
    </div>
    @include('partials.modals.delete')
@endsection
