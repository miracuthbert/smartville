@extends('layouts.master')

@section('title')
    Products & Services - {{ $product->title }}
@endsection

@section('styles')
    <link href="{{ url('css/landing.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('partials.headers.default')

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
                    <h2 class="section-heading">{{ $product->title }}</h2>
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
                           class="btn btn-success btn-lg" data-toggle="tooltip"
                           title="Add {{ $product->title }}">
                            <i class="fa fa-plus"></i>
                            Get Started
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footers.default')

@endsection