@extends('layouts.admin')

@section('title')
    Manual - Create New
@endsection

@section('breadcrumb')
    <li>Documentation</li>
    <li>Manual</li>
    <li class="active">Edit Manual</li>
@endsection

@section('page-header')
    Edit Manual
    <div class="pull-right">
        @include('v1.admin.documentation.manual.chapter_options')
        <!-- chapter options -->
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}" class="btn btn-default btn-sm">
            Preview <i class="fa fa-eye"></i>
        </a>
        <!-- manual options -->
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post"
                      action="{{ route('manual.update', ['docs_manual' => $manual->id]) }}"
                      enctype="application/x-www-form-urlencoded" autocomplete="off">
                    @include('includes.alerts.success')
                    @include('includes.alerts.validation')

                    {{ method_field('put') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Choose an app</label>
                        <select name="app" class="form-control" id="app">
                            <option>Select an app</option>
                            @foreach($app_products as $app)
                                <option value="{{ $app->id }}"
                                        title="{{ $app->title .' ver ('. $app->version_no . ')' }}"
                                        data-url="{{ str_slug($app->title .' '. $app->version_no) }}"
                                        {{ Request::old('app') == $app->id ? 'selected' : $product->id == $app->id ? 'selected' : '' }}>
                                    {{ $app->title }} (ver {{ $app->version_no }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" class="form-control" id="title" placeholder="title"
                               value="{{ Request::old('title') != null ? Request::old('title') : $manual->title }}">
                        <p class="help-block">You can change the manual title or leave it to default.</p>
                    </div>
                    <div class="form-group">
                        <label>Url string</label>
                        <input name="url" class="form-control" id="url" placeholder="url"
                               value="{{ Request::old('url') != null ? Request::old('url') : $manual->url }}">
                        <p class="help-block">You can leave it to default or set a custom one.</p>
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea name="body" class="form-control ckeditor" id="body"
                                  rows="5">{{ Request::old('body') != null ? Request::old('body') : $manual->body }}</textarea>
                        <p class="help-block">The body should contain an introduction and table of contents only.</p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disabled" value="0"
                                    {{ Request::old('status') == 0 ? 'checked' : $manual->status == 0 ? 'checked' : '' }}>
                            Disabled
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="active" value="1"
                                    {{ Request::old('status') == 1 ? 'checked' : $manual->status == 1 ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>
                    <div class="box">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update
                                <i class="fa fa-check-circle-o"></i>
                            </button>
                            <button type="reset" class="btn btn-default">Reset
                                <i class="fa fa-times-circle"></i>
                            </button>
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

            console.log($this);

            //id
            $id = $this.val();
            $selIndex = $this.prop('selectedIndex');
            console.log($selIndex);

            //get url
            $url = $this["0"][$selIndex].dataset.url;
            console.log($url != null ? $url : 'failed url');

            //get title
            $title = $this["0"][$selIndex].title;
            console.log($title != null ? $title : 'failed title');

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