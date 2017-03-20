@extends('v1.layouts.master')

@section('title')
    Apps & Services - {{ $product->title }}
@endsection

@section('styles')
    <link href="{{ url('css/v1/home.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('v1.includes.headers.home.default-static')

    <section class="bg-white" id="services"><!-- Services Section -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $product->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h2 class="section-heading">{{ $product->title }}
                        @if(!$product->mode == 1)
                            <small data-toggle="tooltip"
                                   title="{{ AppModeInfo($product->mode) }}">
                                <span class="label label-warning">Beta</span>
                            </small>
                        @endif
                    </h2>
                    <hr class="star-primary">
                    <h3 class="section-subheading text-muted">{{ $product->summary }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h3 class="section-heading">More details</h3>
                    <hr class="star-primary">
                    <div id="product-details">
                        {{ $product->desc }}
                    </div>

                    <h3 class="section-heading">Features</h3>
                    <hr class="star-primary">
                    <div id="product-features">
                        @foreach($product_features->chunk(3) as $features)
                            <div class="row">
                                @foreach($features as $feature)
                                    <div class="col-md-4">
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

                    <p class="text-muted">
                        <a href="{{ route('app.create', ['app' => str_slug($product->title)]) }}"
                           class="btn btn-default btn-lg" data-toggle="tooltip"
                           title="Add {{ $product->title }}">
                            Get Started
                            <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footers.default')

@endsection