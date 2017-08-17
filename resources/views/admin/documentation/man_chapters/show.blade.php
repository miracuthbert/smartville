@extends('layouts.admin')

@section('title')
    Documentation | {{ $manual->title }} | {{ $chapter->title }}
@endsection

@section('breadcrumb')
    <li>Docs</li>
    <li>
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}">
            {{ $manual->title }}
        </a>
    </li>
    <li class="active">{{ $chapter->title }}</li>
@endsection

@section('page-header')
    {{ $chapter->title }}
    <div class="pull-right">
        @include('admin.documentation.man_chapters.chapters')
        <!-- manual chapter options -->
        @include('admin.documentation.man_chapters.pages')
        <!-- /chapter pages options -->
        <a href="{{ route('manchapter.edit', ['manchapter' => $chapter->id]) }}" class="btn btn-primary btn-sm">
            Edit <i class="fa fa-edit"></i>
        </a>
        <!-- chapter options -->
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    {!! $chapter->body !!}
                </div>
            </div>
        </div>
    </div>
    <footer class="clearfix box">
        <div class="pull-right">
            <strong>Manual:</strong>
            <small>{{ $manual->title }}</small>
        </div>
    </footer>
@endsection