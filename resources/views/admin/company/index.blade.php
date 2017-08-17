@extends('layouts.admin')

@section('title')
    Companies
@endsection

@section('breadcrumb')
    <li class="active">Companies</li>
@endsection

@section('page-header')
    <i class="fa fa-globe"></i> Companies
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($companies as $company)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p>
                                        <span>
                                            {{ $loop->first ? $companies->firstItem() : ($companies->firstItem() + $loop->index) }}.
                                            {{ $company->title }} - <small>{{ $company->country }}</small>
                                        </span>
                                        <span class="badge" data-toggle="tooltip" title="company apps">
                                            {{ $company->apps_count }}
                                        </span>
                                        </p>
                                        <p>
                                            {{ $company->state }} - {{ $company->city }}
                                        </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p>
                                            Joined
                                        <span class="text-muted small">
                                            <em>{{ $company->created_at->diffForHumans() }}</em>
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <p>
                                            <span class="visible-xs-inline">{{ AppStatusText($company->status) }}</span>
                                        <span class="{{ AppStatusIcon($company->status) }}" data-toggle="tooltip"
                                              title="{{ AppStatusText($company->status) }}"></span>
                                        </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="pull-right">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin_company.show', ['admin_company' => $company->id]) }}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                <h4 class="list-group-text">
                                    No companies found.
                                </h4>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of
                                {{ $companies->total() }}
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                {{ $companies->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </div>
            <!-- /.panel-default -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection