@extends('layouts.admin')

@section('title')
    Docs | {{ $manual->title }} | {{ $chapter->title }} - {{ $page->title }}
@endsection

@section('breadcrumb')
    <li>Docs</li>
    <li>
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}">
            {{ $manual->title }}
        </a>
    </li>
    <li>
        <a href="{{ route('manchapter.show', ['manchapter' => $chapter->id]) }}">
            {{ $chapter->title }}
        </a>
    </li>
    <li class="active">{{ $page->title }}</li>
@endsection

@section('page-header')
    {{ $page->title }}
    <div class="pull-right">
{{--        @include('v1.admin.documentation.man_chapters.chapters')--}}
        <!-- manual chapter options -->
        <a href="{{ route('manpage.edit', ['manpage' => $page->id]) }}" class="btn btn-primary btn-sm">
            Edit <i class="fa fa-edit"></i>
        </a>
        <!-- page options -->
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    {!! $page->body !!}
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