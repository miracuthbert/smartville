@extends('layouts.estates')

@section('title')
    Add Tenant Rent Invoice
@endsection

@section('breadcrumb')
    <li class="active">Add Tenant Rent Invoice</li>
@endsection

@section('page-header')
    Add Tenant Rent Invoice
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <form name="add-rent-form" method="get"
                  action="{{ route('estate.rental.rent.generate.invoice', ['id' => $app->id]) }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                @include('includes.alerts.validation')

                @include('includes.alerts.default')

                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <section class="box">
                    <p class="lead">Select properties below to generate their rent invoices:</p>
                </section>

                <section class="box">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset {{ count($properties) > 0 ? '' : 'disabled' }}>
                                <div class="checkbox">
                                    <h4>
                                        <label>
                                            <input type="checkbox" name="group" class="check-group"
                                                   id="0" {{ count($properties) > 0 ? '' : 'disabled' }}>
                                            Ungrouped
                                        </label>
                                    <span class="pull-right badge" data-toggle="tooltip"
                                          title="You can select all properties below by checking group">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    </h4>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @forelse($properties->chunk(4) as $_properties)
                        <div class="row">
                            @foreach($_properties as $property)
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="invoices[]" class="check-group-0"
                                                   value="{{ $property->id }}">
                                            {{ $property->title }} -
                                            {{ $property->tenant->tenant->user->firstname }}
                                            {{ $property->tenant->tenant->user->lastname }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <p class="text-muted">
                            {{ count($properties) > 0 ? '' : 'No ungrouped properties found.' }}
                        </p>
                    @endforelse
                </section>

                @foreach($groups as $group)
                    <section class="box">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset {{ count($group->occupiedProperties) > 0 ? '' : 'disabled' }}>
                                    <div class="checkbox">
                                        <h4>
                                            <label>
                                                <input type="checkbox" name="group" class="check-group"
                                                       id="{{ $group->id }}">
                                                {{ $group->title }}
                                            </label>
                                        <span class="pull-right badge" data-toggle="tooltip"
                                              title="You can select all properties below by checking group">
                                            <i class="fa fa-info"></i>
                                        </span>
                                        </h4>
                                    </div>
                                </fieldset>

                                <p class="text-muted">
                                    {{ count($group->occupiedProperties) > 0 ? '' : 'No properties in this group.' }}
                                </p>
                            </div>
                        </div>

                        @if(count($group->occupiedProperties) > 0)
                            @foreach($group->occupiedProperties->chunk(4) as $_properties)
                                <div class="row">
                                    @foreach($_properties as $property)
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="invoices[]"
                                                           class="check-group-{{ $group->id }}"
                                                           value="{{ $property->id }}">
                                                    {{ $property->title }} -
                                                    {{ $property->tenant->tenant->user->firstname }}
                                                    {{ $property->tenant->tenant->user->lastname }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                    </section>
                    @endif
                @endforeach

                <section class="box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="submit"
                                        class="btn btn-default btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                    Next Step
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

    <script>
        $urlGroupRentProperties = '{{ route('estate.rental.rent.group.properties') }}';
        $urlRentProperty = '{{ route('estate.rental.rent.group.property') }}';
        $urlDateGenerator = '{{ route('parse.date') }}';
        $app = '{{ $app->id }}';

        CKEDITOR.replace('property_desc');
    </script>
@endsection