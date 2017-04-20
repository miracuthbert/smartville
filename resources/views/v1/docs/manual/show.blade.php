@extends('layouts.company')

@section('title')
    Support | Documentation | {{ $manual->title }} Manual
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
                            <li class="active">{{ $manual->title }}</li>
                        </ul>

                        <h1 class="page-header">
                            {{ $manual->title }} Manual
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="clearfix">
                            {!! $manual->body !!}
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Table of Contents</h3>
                        <div class="clearfix">
                            <div class="list-group manuals">
                                @forelse($chapters as $chapter)
                                    <div class="list-group-item">
                                        <header class="clearfix">
                                            <strong class="list-group-item-heading">
                                                {{ $loop->iteration }}.
                                            </strong>
                                            <a href="{{ route('man_chapter.show', ['manual' => $manual->url, 'man_chapter' => $chapter->url]) }}">
                                                {{ $chapter->title }}
                                                <i class="fa fa-chevron-right pull-right"></i>
                                            </a>
                                            <!-- heading -->
                                        </header>
                                        <!-- /header -->
                                        <p class="clearfix">
                                            <strong>{{ $chapter->updated_at != null ? 'Last edited' : 'Written' }}
                                                :</strong>
                                            {{ $chapter->updated_at != null ? $chapter->updated_at->diffForHumans() : $chapter->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <!-- /chapter.list-group-item -->
                                @empty
                                    <p class="lead">No {{ $status }} chapters found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-right">
                            {{ $manual->title }}
                        </p>
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