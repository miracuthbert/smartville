@extends('layouts.admin')

@section('title')
    Emails - {{ title_case($sort) }}
@endsection

@section('breadcrumb')
    <li>Emails</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    Emails - {{ title_case($sort) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(count($messages) > 0)
                <div class="panel panel-default panel-messages">
                    <div class="panel-heading">
                        <section class="messages-heading">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>
                                        <input type="checkbox" name="check_all" id="checkAll" class="checkbox">
                                    </h4>
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group btn-group-sm btn-group-justified btn-group-messages">
                                        <a href="#" class="btn btn-success">
                                            <i class="fa fa-check-circle"></i>
                                            Mark as read
                                        </a>
                                        <a href="#" class="btn btn-default">
                                            <i class="fa fa-mail-reply-all"></i>
                                            Bulk Reply
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group btn-group-sm btn-group-messages">
                                        <a href="#" class="btn btn-warning">
                                            <i class="fa fa-trash-o"></i>
                                            Move To Trash
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                Sort by: {{ title_case($sort) }} <i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('admin.contact.messages', ['sort' => 'unread']) }}">
                                                        Unread
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.contact.messages', ['sort' => 'read']) }}">
                                                        Read
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.contact.messages', ['sort' => 'trashed']) }}">
                                                        Trashed
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.contact.messages', ['sort' => 'all']) }}">
                                                        All
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="panel-body">
                        <section class="messages-wrapper">
                            @foreach($messages as $message)
                                <div class="row message-link-wrapper {{ $message->read_at != null ? 'read' : 'unread' }}">
                                    <div class="col-md-1">
                                        <h4>
                                            <input type="checkbox" name="message[]" id="{{ $message->id }}"
                                                   class="checkbox" value="{{ $message->id }}">
                                        </h4>
                                    </div>
                                    <div class="col-md-3 message-col">
                                        {{ $message->name }}
                                    </div>
                                    <div class="col-md-3 message-col">
                                        {{ $message->email }}
                                    </div>
                                    <div class="col-md-2 message-col">
                                        {{ $message->created_at->diffForHumans() }}
                                    </div>
                                    <div class="col-md-2 message-col">
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('admin.contact.message', ['id' => $message->id]) }}"
                                               class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.contact.message', ['id' => $message->id, 'reply' => 1]) }}"
                                               class="btn btn-default">
                                                <i class="fa fa-mail-reply"></i>
                                            </a>
                                            <a href="{{ route('admin.contact.message', ['id' => $message->id]) }}"
                                               class="btn btn-warning">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status"
                                     aria-live="polite">Showing {{ $messages->first()->id }}
                                    to {{ $messages->last()->id }}
                                    of {{ $messages->total() }} emails
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                    {{ $messages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-footer -->
                </div>
                <!-- /.panel -->
            @else
                <p class="lead">No {{ $sort != "all" ? $sort : '' }} emails found.</p>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection