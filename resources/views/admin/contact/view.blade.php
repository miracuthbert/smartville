@extends('layouts.admin')

@section('title')
    Contact Messages - {{ title_case($message->name) }}
@endsection

@section('styles')
    <link href="{{ url('css/contact.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('admin.contact.messages', ['sort' => 'all']) }}">
            Contact Messages
        </a>
    </li>
    <li>{{ title_case($message->name) }}</li>
    <li class="active">{{ title_case($message->subject) }}</li>
@endsection

@section('page-header')
    {{ title_case($message->subject) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-md-2">
                            <p>
                                <strong>
                                    From:
                                </strong>
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p>{{ title_case($message->name) }}</p>
                            <p class="text-info">{{ $message->email }}</p>
                            <p>
                                <abbr title="phone">{{ $message->phone }}</abbr>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p>
                                <strong>
                                    Date:
                                </strong>
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                {{ $message->created_at->toDayDateTimeString() }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="btn-group btn-group-sm pull-right">
                        <a href="#" class="btn btn-default" id="replyToggle">
                            <i class="fa fa-mail-reply"></i>
                        </a>
                        <a href="{{ route('admin.contact.message', ['id' => $message->id]) }}"
                           class="btn btn-warning">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <hr>

            <div class="row" id="emailMessage">
                <div class="col-md-12">
                    <h2>Message:</h2>
                    {{ $message->message }}
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="" id="replyEmail" enctype="application/x-www-form-urlencoded"
                          style="{{ $reply != 1 ? 'display: none' : '' }};">
                        {{ csrf_field() }}

                        <h2 class="page-header">
                            <i class="fa fa-reply"></i> Reply
                        </h2>

                        @include('partials.alerts.default')

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control"
                                       placeholder="Email Address"
                                       id="email" required
                                       value="{{ $message->email }}">
                                <p class="help-block text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control"
                                       placeholder="subject"
                                       id="subject"
                                       required
                                       value="{{ old('subject') != null ? old('subject') : 'Re: ' . $message->subject }}">
                                <p class="help-block text-danger">{{ $errors->has('subject') ? $errors->first('subject') : '' }}</p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" class="form-control"
                                       placeholder="Phone Number"
                                       id="phone" required
                                       value="{{ $message->phone }}">
                                <p class="help-block text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea name="message" rows="5" class="form-control" placeholder="Message"
                                          id="message">{{ Request::old('message') != null ? Request::old('message') : '' }}</textarea>
                                <p class="help-block text-danger">{{ $errors->has('message') ? $errors->first('message') : '' }}</p>
                            </div>
                        </div>

                        <br>
                        <div id="success"></div>

                        <div class="row control-group">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-primary btn-social">
                                    <i class="fa fa-mail-reply"></i>
                                    Reply
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    <script src="{{ url('js/freelancer.min.js') }}"></script>
@endsection
