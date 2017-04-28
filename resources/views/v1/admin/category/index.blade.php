@extends('layouts.admin')

@section('title')
    Categories
@endsection

@section('breadcrumb')
    <li class="active">Categories</li>
@endsection

@section('page-header')
    Categories
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="list-group">
                @forelse($categories as $category)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5">
                                <p class="lead">
                                    {{ $loop->first ? $categories->firstItem() : ($categories->firstItem() + $loop->index) }}. {{ $category->title }}
                                </p>
                            </div>
                            <div class="col-sm-3">
                                <p>
                                    {{ $category->type }}
                                    {{ cat_level($category->parent) }}
                                    in {{ $category->parent == 0 ? $category->categorable->title : $category->categorable_type }}
                                </p>
                            </div>
                            <div class="col-sm-2">
                                <p>
                                    {{ cat_status($category->status) }}
                                </p>
                            </div>
                            <div class="col-sm-2">
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                           class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('category.destroy', ['category' => $category->id]) }}"
                                           class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No category found.</p>
                @endforelse
                <div class="list-group-item">
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
                </div>
            </div>
        </div>
    </div>
@endsection