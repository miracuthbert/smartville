@extends('layouts.gallery')

@section('title')
    {{ $property->title }} Galleries
@endsection

@section('content')
    @include('includes.headers.estates.gallery')

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">
                <i class="fa fa-camera-retro"></i> {{ $property->title }} Galleries
            </h1>
            <p class="lead">The collection below features <span class="text-muted">{{ $property->title }}</span> photo
                galleries. You can browse them continuously or start from a gallery of your choice.</p>
            <p>
                <a href="#" class="btn btn-primary">Browse</a>
                <a href="#" class="btn btn-default">Property Details</a>
                @can('view', $app)
                <a href="{{ route('estate.rental.property.gallery.create', ['id' => $property->id]) }}"
                   class="btn btn-success" title="Create a new gallery">
                    Create <i class="fa fa-camera fa-fw"></i>
                </a>
                @endcan
            </p>
        </div>
    </section>

    <div id="alerts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts.default')
                </div>
            </div>
        </div>
    </div>

    <div class="album text-muted">
        <div class="container">
            @forelse($galleries->chunk(3) as $_galleries)
                <div class="row">
                    @foreach($_galleries as $gallery)
                        <div class="col-lg-4 col-sm-6">
                            <div class="thumbnail">
                                @if($gallery->cover != null)
                                    <img src="{{ url($gallery->cover) }}"
                                         style="height: 280px; width: 100%; display: block;"
                                         alt="{{ $gallery->title }}">
                                @else
                                    <img data-src="holder.js/100px280/thumb" alt="No cover found"
                                         title="No cover found">
                                @endif
                                <div class="caption">
                                    <h3>{{ $gallery->title }}</h3>
                                    <p>{{ str_limit($gallery->summary) }}</p>
                                    <p>
                                        <a href="" class="btn btn-default">
                                            Browse <i class="fa fa-camera-retro"></i>
                                        </a>
                                        @can('view', $app)
                                        <a href="" class="btn btn-primary">
                                            Edit <i class="fa fa-camera-edit"></i>
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
                <p class="lead text-center">Seems like this property has no images or galleries.</p>
            @endforelse

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="thumbnail">
                        <img src="{{ url('images/site/v1/landing/6.jpg') }}" height="280px" alt="Card image cap">
                        <div class="caption">
                            <h3>Gallery 1</h3>
                            <p>This is a wider thumbnail with supporting text below as a natural
                                lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <!-- /.thumbnail -->
                <div class="col-lg-4 col-sm-6">
                    <div class="thumbnail">
                        <img src="{{ url('images/site/v1/landing/7.jpg') }}" height="280px" alt="Card image cap">
                        <div class="caption">
                            <h3>Gallery 2</h3>
                            <p>This is a wider thumbnail with supporting text below as a natural
                                lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <!-- /.thumbnail -->
                <div class="col-lg-4 col-sm-6">
                    <div class="thumbnail">
                        <img src="{{ url('images/site/v1/landing/77.jpg') }}" height="280px" alt="Card image cap">
                        <div class="caption">
                            <h3>Gallery 3</h3>
                            <p>This is a wider thumbnail with supporting text below as a natural
                                lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <!-- /.thumbnail -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.album -->

@endsection
