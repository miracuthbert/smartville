@extends('layouts.admin')

@section('title')
    Docs | {{ $man->title }} | {{ $chapter }} | Page - Create New
@endsection

@section('breadcrumb')
    <li>Docs</li>
    <li>{{ $man->title }}</li>
    <li>{{ $chapter->title }}</li>
    <li>Page</li>
    <li class="active">Create New</li>
@endsection

@section('page-header')
    Create New Page in Chapter
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post" action="{{ route('manpage.store') }}"
                      enctype="application/x-www-form-urlencoded" id="man-chapter" autocomplete="off">
                    @include('includes.alerts.success')
                    @include('includes.alerts.validation')

                    {{ csrf_field() }}

                    <input type="hidden" name="manual" id="manual" value="{{ $man->id }}">

                    <input type="hidden" name="chapter" id="manual" value="{{ $chapter->id }}">

                    <div class="form-group">
                        <label>Manual</label>
                        <p class="form-control-static">{{ $man->title }}</p>
                    </div>

                    <div class="form-group">
                        <label>Choose an app feature</label>
                        <p class="form-control-static">{{ $chapter->title }}</p>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" class="form-control" id="title" placeholder="title"
                               value="{{ Request::old('title') }}">
                        <p class="help-block">This is the page title</p>
                    </div>

                    <div class="form-group">
                        <label>Url string</label>
                        <input name="url" class="form-control" id="url" placeholder="url"
                               value="{{ Request::old('url') }}">
                        <p class="help-block">You can leave it to default or set a custom one.</p>
                    </div>

                    <div class="form-group">
                        <label>Body</label>
                        <textarea name="body" class="form-control ckeditor" id="body"
                                  rows="5">{{ Request::old('body') }}</textarea>
                        <p class="help-block">The body should contain content of the page</p>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disabled"
                                   value="0" {{ Request::old('status') == 0 ? 'checked' : '' }}>
                            Disabled
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="active"
                                   value="1" {{ Request::old('status') == 1 ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //custom url
        $('input#title').on('focusout', function () {

            //init
            $this = $(this);

            //value
            $text = $this.val();

            //replace empty spaces
            $text = $text.toLowerCase().replace(/[" "]/g, '-').replace(/[,]/g, ''); //.replace(/[^\d\.]+/g,'');

            //append value
            $('input#url').val($text);

        });

        CKEDITOR.replace('ckeditor');
    </script>
@endsection