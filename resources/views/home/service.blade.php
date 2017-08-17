@extends('layouts.company.master')

@section('title')
    Apps & Services - {{ $product->title }}
@endsection

@section('content')

    <div class="section-pad"></div>

    <div class="bg-white clearfix" id="service"><!-- Services Section -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2 class="page-header">
                        <span class="fa-stack fa-3x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $product->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                    {{ $product->title }}

                    @if($product->mode != 1)
                        <small data-toggle="tooltip"
                               title="{{ AppModeInfo($product->mode) }}">
                            <span class="label label-warning">Beta</span>
                        </small>
                    @endif
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="clearfix" id="summary">
                    {!! $product->summary !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <hr>
                <div id="product-details">
                    {!! $product->desc !!}
                </div>
            </div>
        </div>

        <div class="row hidden">
            <div class="col-lg-8 col-lg-offset-2">
                <h3 class="section-heading">Features</h3>
                <hr>
                <div id="product-features text-center">
                    @foreach($product_features->chunk(3) as $features)
                        <div class="row">
                            @foreach($features as $feature)
                                <div class="col-md-12">
                                    <dt>
                                        {{ $feature->feature }}
                                        <span class="pull-right">
                                                <i class="fa {{ $feature->status == 1 ? 'fa-check' : 'fa-check' }}"></i>
                                            </span>
                                    </dt>
                                    <dd>{{ $feature->details }}</dd>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($product->coming_soon == 0)
            <div class="row" id="button">
                <div class="col-lg-8 col-lg-offset-2">
                    <a href="{{ route('app.create', ['app' => str_slug($product->title)]) }}"
                       class="btn btn-default btn-lg pull-right" data-toggle="tooltip"
                       title="Create {{ $product->title }}">
                        Get Started
                        <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>

@endsection