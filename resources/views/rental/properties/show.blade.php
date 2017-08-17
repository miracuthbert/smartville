@extends('layouts.gallery')

@section('title')
    {{ $property->title }}
@endsection

@section('styles')
    @if($cover == null)
        <style>
            .jumbotron {
                color: #FFFFFF;
                background-color: #2c3e50;
            }

            .jumbotron-text {
                background-color: transparent;
                opacity: 1;
            }
        </style>
        <!-- /styles when cover is not photo available -->
        @endif

        @if($cover != null)
                <!-- /styles when cover photo available -->
    @endif
@endsection

@section('content')
    @include('partials.headers.estates.gallery')

    <section class="{{ $cover != null ? 'bg' : '' }} jumbotron text-center"
             style="background: @if($cover != null) url({{ url($cover) }}) @else '#2c3e50' @endif;">
        <div class="container">
            <div class="box">
                <h1 class="jumbotron-heading">
                    <i class="fa fa-home"></i> {{ $property->title }}
                    @can('update', $app)
                    <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                       class="btn btn-primary btn-sm" title="Edit property">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>
                    @endcan
                </h1>

                <div class="jumbotron-text">
                    <p class="lead">
                        {{ $property->summary }}
                    </p>
                    <h3 class="jumbotron-heading">
                        {{ $currency }}. {{ $price->price }}
                    </h3>
                </div>

                <div class="box">
                    <p>
                        <a href="#details" class="btn {{ $cover != null ? 'btn-default' : 'btn-primary' }} btn-sm"
                           style="border-radius: 0; border: 0;"
                           role="button" data-toggle="tooltip" title="more detailed info">
                            More details <i class="fa fa-angle-down fa-fw"></i>
                        </a>
                        <!-- /a#details -->
                        <a href="#features" class="btn {{ $cover != null ? 'btn-default' : 'btn-primary' }} btn-sm"
                           style="border-radius: 0; border: 0;"
                           role="button" data-toggle="tooltip" title="property features">
                            Features <i class="fa fa-angle-down fa-fw"></i>
                        </a>
                    </p>
                    <p>
                        <!-- /a#features -->
                        <a href="#amenities" class="btn {{ $cover != null ? 'btn-default' : 'btn-primary' }} btn-sm"
                           style="border-radius: 0; border: 0;"
                           role="button" data-toggle="tooltip" title="property amenities">
                            Amenities <i class="fa fa-angle-down fa-fw"></i>
                        </a>
                        <!-- /a#amenities -->
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /.jumbotron -->

    <section id="property-details-wrapper" class="box">
        <div class="container">
            <div id="details" class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Details</h2>
                    <div class="clearfix">
                        {!! $property->description !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div id="features" class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Features
                        @can('update', $app)
                        <div class="pull-right">
                            <a href="{{ route('estate.rental.property.features', ['id' => $property->id]) }}"
                               class="btn btn-primary">
                                Edit Features <i class="fa fa-edit"></i>
                            </a>
                        </div>
                        @endcan
                    </h2>
                    <div class="list-group">
                        @forelse($features as $feature)
                            <div class="list-group-item">
                                <h3 class="list-group-item-heading">{{ $feature->title }}</h3>
                                <div class="list-group-text">{{ $feature->details }}</div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                <h3>No features listed.</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div id="amenities" class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Amenities
                        @can('update', $app)
                        <div class="pull-right">
                            <a href="{{ route('estate.rental.property.amenities', ['id' => $property->id]) }}"
                               class="btn btn-primary">
                                Edit Amenities <i class="fa fa-edit"></i>
                            </a>
                        </div>
                        @endcan
                    </h2>
                    <div class="list-group">
                        @forelse($amenities as $amenity)
                            <div class="list-group-item">
                                <h3 class="list-group-item-heading">{{ $amenity->amenity->title }}</h3>
                                <div class="list-group-text">{{ $amenity->amenity->description }}</div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                <h3>No features listed.</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.property-details-wrapper -->

    <div id="fancyBox" class="box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Photos
                        <div class="pull-right">
                            @can('update', $app)
                            <a href="{{ route('estate.rental.property.gallery.index', ['id' => $property->id]) }}"
                               class="btn btn-primary" title="Edit property galleries">
                                Edit Galleries <i class="fa fa-camera fa-fw"></i>
                            </a>
                            @endcan
                        </div>
                    </h2>
                    @if($property->galleries_count > 0)
                        @foreach($property->galleries as $gallery)
                            <h3>
                                <i class="fa fa-camera-retro fa-fw"></i>
                                {{ $gallery->title }} Gallery
                            </h3>
                            @if($gallery->cover != null)
                                <p>
                                    <a href="{{ url($gallery->cover) }}" data-fancybox="group"
                                       data-caption="{{ $gallery->title }} : {{ !empty($gallery->summary) ? $gallery->summary : 'No description available' }}">
                                        <img src="{{ url($gallery->cover) }}" class="img-responsive"
                                             alt="{{ $gallery->title }} gallery cover">
                                    </a>
                                </p>
                            @endif
                            <div class="row">
                                @forelse($gallery->public_photos as $photo)
                                    <div class="col-lg-4 col-sm-6 col-xs-6">
                                        <div class="thumbnail">
                                            <a href="{{ url($photo->photo) }}" data-fancybox="group"
                                               data-caption="{{ $photo->caption }} : {{ !empty($photo->description) ? $photo->description : 'No description available' }}">
                                                <img src="{{ url($photo->data['shelfUrl']) }}"
                                                     alt="{{ $photo->caption }} thumbnail"/>
                                                <div class="caption">
                                                    <h3>{{ $photo->caption }}</h3>
                                                </div>
                                            </a>
                                            <div class="caption">
                                                <p>
                                                    <i class="fa fa-{{ $photo->audience_id == 17 ? 'globe' : '' }}"></i>
                                                    <span class="text-muted">
                                                        {{ $photo->audience->title }}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="fa fa-map-marker"></i>
                                                    <span class="text-muted">
                                                    {{ $photo->location != null ? $photo->location : 'None' }}
                                                </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="lead text-center">
                                        <i class="fa fa-photo"></i> No photos in this gallery
                                        <a href="{{ route('estate.rental.property.image.create', ['id' => $gallery]) }}"
                                           class="btn btn-success btn-sm">
                                            Add photo <i class="fa fa-photo"></i>
                                        </a>
                                    </p>
                                @endforelse
                            </div>
                            <!-- /.row -->
                        @endforeach
                    @else
                        <p class="lead">Property has no images</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /#fancyBox -->
@endsection