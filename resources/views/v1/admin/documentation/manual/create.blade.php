@extends('layouts.admin')

@section('title')
    Manual - Create New
@endsection

@section('breadcrumb')
    <li>Manual</li>
    <li class="active">Create New</li>
@endsection

@section('page-header')
    Create New Manual
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post" action="{{ route('manual.store') }}"
                      enctype="application/x-www-form-urlencoded" autocomplete="off">
                    @include('includes.alerts.success')
                    @include('includes.alerts.validation')

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Stand alone manual</label>
                        <label class="radio-inline">
                            <input type="radio" name="stand_alone" id="false"
                                   value="0" {{ Request::old('stand_alone') == 0 ? 'checked' : '' }}>
                            No, I want to create and app manual
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="stand_alone" id="true"
                                   value="1" {{ Request::old('stand_alone') == 1 ? 'checked' : '' }}>
                            Yes
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Choose an app</label>
                        <select name="app" class="form-control" id="app">
                            <option>Select an app</option>
                            @foreach($app_products as $app)
                                <option value="{{ $app->id }}"
                                        title="{{ $app->title .' ver ('. $app->version_no . ')' }}"
                                        data-url="{{ str_slug($app->title .' ver '. $app->version_no) }}"
                                        value="{{ Request::old('app') == $app->id ? 'selected' : '' }}">
                                    {{ $app->title }} (ver {{ $app->version_no }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" class="form-control" id="title" placeholder="title"
                               value="{{ Request::old('title') }}">
                        <p class="help-block">You can change the manual title or leave it to default.</p>
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
                        <p class="help-block">The body should contain an introduction and table of contents only.</p>
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
        $('select#app').on('change', function () {

            $this = $(this);

            //id
            $id = $this.val();
            $selIndex = $this.prop('selectedIndex');

            //get url
            $url = $this["0"][$selIndex].dataset.url;

            //get title
            $title = $this["0"][$selIndex].title;

            //manual title
            $('input#title').val($title);

            //manual url
            $('input#url').val($url);

        });

        //custom url
        $('input#title').on('focusout', function () {

            //init
            $this = $(this);

            //value
            $text = $this.val();

            //replace empty spaces
            $text = $text.toLowerCase().replace(/[" "]/g, '-').replace(/[,]/g, '')
            $text = $text.replace(/[(]/g, '').replace(/[)]/g, '');

            //.replace(/[^\d\.]+/g,'');

            //append value
            $('input#url').val($text);

        });

        CKEDITOR.replace('ckeditor');
    </script>
@endsection