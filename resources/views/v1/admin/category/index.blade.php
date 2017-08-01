@extends('layouts.admin')

@section('title')
    Categories
@endsection

@section('breadcrumb')
    <li class="active">Categories</li>
@endsection

@section('page-header')
    Categories
    <hr class="visible-xs">
    <div class="pull-right">
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Actions... <i class="fa fa-caret"></i>
            </button>
            <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('category.slugs') }}">Generate Missing Slugs</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')

            <div class="panel-group" id="accordion">
                @forelse($categories as $category)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('category.edit', ['category' => $category->id]) }}">
                                <h3>
                                    {{ $category->title }}
                                    <span class="pull-right">
                                            <i class="fa {{ $category->status == 1 ? 'fa-check' : 'fa-clock-o' }}"></i>
                                        </span>
                                </h3>
                            </a>

                            <p>{{ str_limit($category->desc) }}</p>

                            @if($category->categories->count() > 0)
                                <h4 class="lead" data-toggle="collapse" data-parent="#accordion"
                                    data-target="#collapse{{ $category->id }}"
                                    role="button">
                                    Child Categories
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                </h4>
                            @endif
                        </div>
                        @if($category->categories->count() > 0)
                            <div class="panel-collapse collapse" id="collapse{{ $category->id }}">
                                <div class="panel-body">
                                    @foreach($category->categories as $cat)
                                        <div class="list-group-item">
                                            <div class="list-group-heading">
                                                <a href="{{ route('category.edit', ['category' => $cat]) }}">
                                                    <h4>
                                                        {{ $cat->title }}
                                                        <span class="pull-right">
                                                                    <i class="fa {{ $cat->status == 1 ? 'fa-check' : 'fa-clock-o' }}"></i>
                                                                </span>
                                                    </h4>
                                                </a>
                                            </div>
                                            <div class="list-group-text">
                                                <p>{{ str_limit($cat->desc) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div><!-- /.panel-collapse -->
                        @endif
                    </div><!-- /.panel-default -->
                @empty
                    <div class="list-group-item">
                        <div class="list-geoup-heading">
                            <h4>Sorry, categories not found!</h4>
                        </div>
                    </div>
                @endforelse
            </div><!-- /.panel-group -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-sm-6 text-center-xs">
            <p>
                Categories: Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }}
                of {{ $categories->total() }}
            </p>
        </div>
        <div class="col-sm-6">
            <div class="pull-right">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection