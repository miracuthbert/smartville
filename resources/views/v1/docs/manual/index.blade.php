@extends('layouts.company')

@section('title')
    Support Center | Documentation - Manuals
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <div id="support-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li>Support</li>
                        <li>Documentation</li>
                        <li class="active">Manuals</li>
                    </ul>

                    <h1 class="page-header">
                        <i class="fa fa-book"></i> Manuals
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-9 col-sm-8">
                    <div class="list-group manuals">
                        @forelse($manuals as $manual)
                            <div class="list-group-item">
                                <header class="clearfix">
                                    <strong class="list-group-item-heading">
                                        {{ $loop->iteration }}.
                                    </strong>
                                    <a href="{{ route('manuals.show', ['manual' => $manual->url]) }}">
                                        {{ $manual->title }}
                                        <i class="fa fa-chevron-right pull-right"></i>
                                    </a>
                                    <!-- heading -->
                                </header>
                                <!-- /header -->
                                <footer class="clearfix">
                                    <strong>{{ $manual->updated_at != null ? 'Last edited' : 'Written' }}:</strong>
                                    {{ $manual->updated_at != null ? $manual->updated_at->diffForHumans() : $manual->created_at->diffForHumans() }}
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                Chapters
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                @forelse($manual->chapters as $chapter)
                                                    <li>
                                                        <a href="{{ route('man_chapter.show', ['manual' => $manual->url, 'man_chapter' => $chapter->url]) }}">
                                                            {{ $chapter->title }}
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li class="text-center">No chapters found</li>
                                                @endforelse
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="{{ route('man_chapter.index', ['manual' => $manual->id]) }}">
                                                        View All
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- chapter options -->
                                    </div>
                                </footer>
                            </div>
                            <!-- /manual.list-group-item -->
                        @empty
                            <p class="lead">No {{ $status }} manuals found.</p>
                        @endforelse
                    </div>
                </div>
                <!-- /.col-lg-9 -->
                <!-- support sidebar -->
                @include('includes.sidebars.support-v1')
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /#support-wrapper -->

    <!-- footer -->
    @include('includes.footers.default')
@endsection

@section('scripts')
@endsection