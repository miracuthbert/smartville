@extends('v1.layouts.dashboard')

@section('title')
    Support | Documentation | {{ $manual->title }} Manual | {{ $chapter->title }} | {{ $page->title }}
@endsection

@section('breadcrumb')
    <li>Support</li>
    <li>Documentation</li>
    <li>{{ $manual->title }}</li>
    <li>{{ $chapter->title }}</li>
    <li class="active">{{ $page->title }}</li>
@endsection

@section('page-header')
    {{ $page->title }}
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
        <div class="row">
            <div class="col-lg-12">
                <div class="text-right">
                    {{ $manual->title }} | {{ $chapter->title }} | {{ $page->title }}
                </div>
            </div>
        </div>
    </div>
@endsection