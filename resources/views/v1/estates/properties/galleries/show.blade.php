@extends('layouts.gallery')

@section('title')
    {{ $property->title }} - {{ $gallery->title }} Gallery
@endsection

@section('content')
    @include('includes.headers.estates.gallery')

    <section class="jumbotron text-center {{ $gallery->cover != null ? 'bg' : '' }}"
             style="background: url('{{ url($gallery->cover) }}')">
        <div class="container">
            <div class="box">
                <h1 class="jumbotron-heading">
                    <i class="fa fa-camera-retro"></i> {{ $gallery->title }}
                </h1>

                <div class="jumbotron-text">
                    <p class="lead">
                        {{ $gallery->summary }}
                    </p>
                </div>
            </div>

            <div class="jumbotron-buttons">
                @can('update', $app)
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                       class="btn btn-primary" title="Edit this gallery's property">
                        Edit Property <i class="fa fa-edit fa-fw"></i>
                    </a>
                    <a href="{{ route('estate.rental.property.gallery.edit', ['id' => $gallery->id]) }}"
                       class="btn btn-primary" title="Edit gallery">
                        Edit Gallery <i class="fa fa-camera fa-fw"></i>
                    </a>
                    <a href="{{ route('estate.rental.property.image.create', ['id' => $gallery->id]) }}"
                       class="btn btn-success" title="Add photo to gallery">
                        Add photo <i class="fa fa-photo fa-fw"></i>
                    </a>
                </div>
                @endcan
            </div>

            <p class="text-center">
                <a href="#" class="btn btn-default">Property Details <i class="fa fa-home fa-fw"></i></a>
            </p>
        </div>
    </section>

    <div class="album text-muted">
        <div class="container">

            <div id="alerts">
                @include('includes.alerts.default')
            </div>

            @forelse($photos->chunk(3) as $_photos)
                <div class="row">
                    @foreach($_photos as $photo)
                        <div class="col-lg-4 col-sm-6">
                            <div class="thumbnail">
                                @if($photo->photo != null)
                                    <img src="{{ url($photo->data['shelfUrl']) }}"
                                         style="height: 280px; width: 100%; display: block;"
                                         alt="{{ $photo->title }}">
                                @else
                                    <img data-src="holder.js/100px280/thumb" alt="No image found"
                                         title="No image found">
                                @endif
                                <div class="caption">
                                    <h3>{{ $photo->caption }}</h3>
                                    <p>
                                        <i class="fa fa-map-marker"></i>
                                        <span class="text-muted">
                                            {{ $photo->location != null ? $photo->location : 'None' }}
                                        </span>
                                    </p>
                                    <p>
                                        <i class="fa fa-{{ $photo->audience_id == 17 ? 'globe' : '' }}"></i>
                                        {{ $photo->audience->title }}
                                    </p>
                                    <p>{{ str_limit($photo->description) }}</p>
                                    <p>
                                        <a href="{{ url($photo->photo) }}" class="btn btn-default btn-sm"
                                           data-toggle="modal" data-target="#">
                                            View large <i class="fa fa-expand"></i>
                                        </a>
                                        @can('view', $app)
                                        <a href="{{ route('estate.rental.property.image.edit', ['id' => $photo->id]) }}"
                                           class="btn btn-primary btn-sm" title="edit">
                                            Edit <i class="fa fa-edit"></i>
                                        </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.thumbnail -->
                    @endforeach
                </div>
                <!-- /.row -->
            @empty
                <p class="lead text-center">Seems like this gallery has no images</p>
            @endforelse
        </div>
        <!-- /.container -->
    </div>
    <!-- /.album -->

@endsection
