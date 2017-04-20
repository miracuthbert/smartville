@extends('layouts.company')

@section('title')
    Support | Documentation | {{ $manual->title }} Manual | {{ $chapter->title }}
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <div id="manual-wrapper">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>Support</li>
                            <li>Documentation</li>
                            <li>{{ $manual->title }}</li>
                            <li class="active">{{ $chapter->title }}</li>
                        </ul>

                        <h1 class="page-header">
                            {{ $chapter->title }}
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-9 col-sm-8">
                        <div class="clearfix">
                            {!! $chapter->body !!}
                        </div>
                    </div>
                    <!-- /.col-lg-9 -->
                    <div class="col-lg-3 col-sm-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <span class="list-group-item-heading">{{ $manual->title }}</span>
                                <p class="list-group-item-text">Table of Contents</p>
                            </a>
                            @forelse($manual->chapters as $chapter)
                                <a href="{{ route('man_chapter.show', ['manual' => $manual->url, 'man_chapter' => $chapter->url]) }}" class="list-group-item {{ ActiveUrl(route('man_chapter.show', ['manual' => $manual->url, 'man_chapter' => $chapter->url])) }}">
                                    {{ $chapter->title }}
                                </a>
                            @empty
                                <span class="list-group-item">No chapters found</span>
                            @endforelse
                                <a href="{{ route('manuals.show', ['manual' => $manual->url]) }}" class="list-group-item">
                                    View All
                                </a>
                        </div>
                    </div>
                    <!-- /.col-lg-3 -->
                </div>
                <!-- /.row -->

                @if(count($chapter->pages)>0)
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Chapter Contents</h3>
                            <div class="clearfix">
                                <div class="list-group">
                                    @forelse($chapter->pages as $page)
                                        <div class="list-group-item">
                                            <a href="{{ route('man_page.show', ['manual' => $manual->url, 'man_chapter' => $chapter->url, 'man_page' => $page->url]) }}">
                                                {{ $page->title }}
                                                <i class="fa fa-chevron-right pull-right"></i>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="lead">No pages found in this chapter.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                @endif

                <div class="row">
                    <div class="col-lg-9">
                        <p class="text-right">{{ $manual->title }} | {{ $chapter->title }}</p>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#manual-wrapper -->

    <!-- footer -->
    @include('includes.footers.default')
@endsection
