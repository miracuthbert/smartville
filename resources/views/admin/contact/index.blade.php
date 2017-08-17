@extends('layouts.admin')

@section('title')
    Contact Messages - {{ title_case($sort) }}
@endsection

@section('breadcrumb')
    <li>Contact Messages</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    Contact Messages - {{ title_case($sort) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('partials.alerts.default')

            <form action="" id="admin-contact-messages-form">
                <div class="list-group messages-wrapper">
                    <div class="list-group-item">
                        <div class="list-group-heading messages-heading">
                            <div class="row">
                                <div class="col-sm-1 col-xs-2 text-center">
                                    <p>
                                        <input type="checkbox" name="check_all" id="check-all" class="checkbox"
                                               data-target="checkbox">
                                    </p>
                                </div>
                                <div class="col-sm-11 col-xs-10">
                                    <div class="clearfix">
                                        <div class="pull-right">
                                            <a href="{{ route('admin.contact.message.toggle_read', ['message' => 'all']) }}"
                                               class="btn btn-success btn-sm">
                                                <i class="fa fa-check-circle"></i> Mark All as Read
                                            </a>
                                            <div class="btn-group btn-group-sm btn-group-messages">
                                                <button href="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    Actions <i class="fa fa-caret-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li class="dropdown-header">With selected:</li>
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault(); toggleAsRead();">
                                                            <i class="fa fa-check-circle"></i>
                                                            Mark as read
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-mail-reply-all"></i>
                                                            Bulk Reply
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i>
                                                            Move To Trash
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <button href="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    Sort by: {{ title_case($sort) }} <i class="fa fa-caret-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.list-group-heading -->
                    </div>
                    <!-- /.list-group-item -->
                    @forelse($messages as $message)
                        <div class="list-group-item message-link-wrapper {{ $message->read_at != null ? 'read' : 'unread' }}">
                            <div class="row">
                                <div class="col-sm-1 col-xs-2 text-center">
                                    <p>
                                        <input type="checkbox" name="message[]" id="{{ $message->id }}"
                                               class="checkbox" value="{{ $message->id }}">
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-10 message-col">
                                    <a href="{{ route('admin.contact.messages', ['from' => $message->name, 'sort' => 'name']) }}">
                                        {{ $message->name }}
                                        @if(!$message->read_at)
                                            <span class="label label-success" data-toggle="tooltip" title="Unread">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                        @endif
                                    </a>
                                </div>
                                <div class="col-sm-4 message-col">
                                    {{ str_limit($message->subject) }}
                                </div>
                                <div class="col-sm-2 message-col text-center"
                                     title="{{ $message->created_at->toDayDateTimeString() }}">
                                    {{ $message->created_at->diffForHumans() }}
                                </div>
                                <div class="col-sm-1 message-col text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            Actions <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            @if(!$message->read_at)
                                                <li>
                                                    <a href="{{ route('admin.contact.message.toggle_read', ['message' => $message->id]) }}"
                                                       title="mark as read">
                                                        <i class="fa fa-check-circle"></i> Mark as read
                                                    </a>
                                                </li><!-- /toggle-read -->
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.contact.message', ['message' => $message->id]) }}"
                                                   title="read message">
                                                    <i class="fa fa-envelope-square"></i> Read message
                                                </a>
                                            </li><!-- /view-message -->
                                            <li>
                                                <a href="{{ route('admin.contact.message', ['message' => $message->id, 'reply' => 1]) }}"
                                                   title="reply">
                                                    <i class="fa fa-mail-reply"></i> Reply
                                                </a>
                                            </li><!-- /reply -->
                                            @if($sort != "trashed")
                                                <li>
                                                    <a href="{{ route('admin.contact.message', ['message' => $message->id]) }}"
                                                       title="move to trash">
                                                        <i class="fa fa-trash-o"></i> Move to trash
                                                    </a>
                                                </li><!-- /move-to-trash -->
                                            @endif
                                        </ul><!-- /.dropdown-menu -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.list-group-item -->
                    @empty
                        <p class="lead">No {{ $sort != "all" ? $sort : '' }} emails found.</p>
                    @endforelse
                    <div class="list-group-item">
                        <div class="list-group-heading">
                            <div class="row">
                                <div class="col-sm-6 text-center-xs">
                                    <p>
                                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }}
                                        of {{ $messages->total() }} messages
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        {{ $messages->appends($query_string)->render() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.list-group-heading -->
                </div>
            </form>
            <!-- /.list-group -->
        </div>
        <!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <!-- Scripts -->
    <script>
        var toggleAsRead = function () {
            document.getElementById('admin-contact-messages-form')
                    .setAttribute('action', '{{ route('admin.contact.message.toggle_read') }}');
            document.getElementById('admin-contact-messages-form').submit()
        };
    </script>
@endsection