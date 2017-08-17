@extends('layouts.admin')

@section('title')
    Bugs | {{ $bug->title }}
@endsection

@section('breadcrumb')
    <li>Bugs</li>
    <li>{{ $bug->title }}</li>
@endsection

@section('page-header')
    {{ $bug->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="box">
                <header>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>
                                <strong>Reported by:</strong> {{ $bug->user->firstname . ' ' . $bug->user->lastname }}
                            </p>
                            <p>
                                <strong>Reported at:</strong> {{ $bug->created_at->diffForHumans() }}
                            </p>
                            <p>
                                <strong>Feature:</strong> {{ $feature->feature }}
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="pull-right">
                                <a href="{{ route('bugs.status', ['bug' => $bug->id]) }}"
                                   class="btn {{ bug_button_state($bug->solved_at) }}">
                                    {{ bug_button_text($bug->solved_at) }} <i class="fa fa-check-square-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div id="bug-wrapper" class="clearfix">
                    {!! $bug->details !!}
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Bug solution</h3>
        </div>
    </div>
@endsection