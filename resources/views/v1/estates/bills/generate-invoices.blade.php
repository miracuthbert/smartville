@extends('layouts.estates')

@section('title')
    Generate Bill Invoices
@endsection

@section('breadcrumb')
    <li>Bills</li>
    <li></li>
    <li class="active">Generate Bill Invoice</li>
@endsection

@section('page-header')
    Generate Bill Invoice
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <form name="generate-bill-form" method="get" action="{{ route('estate.rental.bill.add', ['id' => $app->id]) }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                @include('includes.alerts.validation')

                @include('includes.alerts.default')

                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <section class="box">
                    <div class="form-group">
                        <label>Billing for:</label>
                        @foreach($bills->chunk(4) as $billsChunked)
                            <div class="row">
                                @foreach($billsChunked as $bill)
                                    <div class="col-md-3">
                                        <label class="radio-inline">
                                            <input type="radio" name="bill" value="{{ $bill->id }}"
                                                    {{ Request::old('bill') == $bill->id ? 'checked' : '' }}>
                                            {{ $bill->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="box">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_date">From date:</label>
                                    <input type="text" name="from_date" class="form-control date-selector"
                                           id="from_date" value="{{ Request::old('from_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="due_date">Due date:</label>
                                <div class="form-group">
                                    <input type="text" name="due_date" class="form-control date-selector" id="due_date"
                                           value="{{ Request::old('due_date') }}">
                                </div>
                            </div>
                        </div>
                        <p class="help-block">You can still change the dates in the next step.</p>
                    </div>
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

                    @foreach($properties->chunk(4) as $_properties)
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

                            <p class="text-muted">
                                {{ count($properties) > 0 ? '' : 'No ungrouped properties found.' }}
                            </p>
                        </div>
                    @endforeach
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
                            <button type="submit" class="btn btn-default">Next step
                                <i class="fa fa-chevron-right"></i>
                            </button>
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