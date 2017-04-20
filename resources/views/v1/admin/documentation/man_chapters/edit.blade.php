@extends('layouts.admin')

@section('title')
    Docs | {{ $manual->title }} - Edit Manual Chapter
@endsection

@section('breadcrumb')
    <li>Docs</li>
    <li>
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}">
            {{ $manual->title }}
        </a>
    </li>
    <li>Chapter</li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    Edit Manual Chapter
    <div class="pull-right">
        @include('v1.admin.documentation.man_chapters.chapters')
        <!-- /manual chapter options -->
        @include('v1.admin.documentation.man_chapters.pages')
        <!-- /chapter pages options -->
        <a href="{{ route('manchapter.show', ['manchapter' => $chapter->id]) }}" class="btn btn-default btn-sm">
            Preview <i class="fa fa-eye"></i>
        </a>
        <!-- /chapter options -->
    </div>
@endsection


@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post"
                      action="{{ route('manchapter.update', ['manchapter' => $chapter->id]) }}"
                      enctype="application/x-www-form-urlencoded" autocomplete="off">
                    @include('includes.alerts.success')
                    @include('includes.alerts.validation')

                    {{ method_field('put') }}

                    {{ csrf_field() }}

                    <input type="hidden" name="manual" id="manual" value="{{ $manual->id }}">

                    <div class="form-group">
                        <label>Manual</label>
                        <p class="form-control-static">{{ $manual->title }}</p>
                    </div>

                    @if(count($features) > 0)
                        <div class="form-group">
                            <label>Choose an app feature</label>
                            <select name="feature" class="form-control" id="feature">
                                <option>Select an app feature</option>
                                <option value="none"
                                        {{ Request::old('feature') == 'none' ? 'selected' : $chapter->featureable_id == "" ? 'selected' : '' }}>
                                    None
                                </option>
                                @foreach($features as $feature)
                                    <option value="{{ $feature->id }}" title="{{ $feature->feature }}"
                                            data-url="{{ str_slug($feature->feature) }}"
                                            {{ Request::old('feature') == $feature->id ? 'selected' : $chapter->featureable_id == $feature->id ? 'selected' : '' }}>
                                        {{ $feature->feature }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" class="form-control" id="title" placeholder="title"
                               value="{{ Request::old('title') != null ? Request::old('title') : $chapter->title }}">
                        <p class="help-block">You can change the manual title or leave it to default.</p>
                    </div>

                    <div class="form-group">
                        <label>Url string</label>
                        <input name="url" class="form-control" id="url" placeholder="url"
                               value="{{ Request::old('url') != null ? Request::old('url') : $chapter->url }}">
                        <p class="help-block">You can leave it to default or set a custom one.</p>
                    </div>

                    <div class="form-group">
                        <label>Body</label>
                        <textarea name="body" class="form-control ckeditor" id="body"
                                  rows="5">{{ Request::old('body') != null ? Request::old('body') : $chapter->body }}</textarea>
                        <p class="help-block">The body should contain an introduction and table of contents only.</p>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disabled" value="0"
                                    {{ Request::old('status') == 0 ? 'checked' : $chapter->status == 0 ? 'checked' : '' }}>
                            Disabled
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="active" value="1"
                                    {{ Request::old('status') == 1 ? 'checked' : $chapter->status == 1 ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
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
        $('select#feature').on('change', function () {

            $this = $(this);

            //find featureable
            $feat = $('form#man-chapter').find('input#featureable');

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

            if ($id == "none")//Rental Management App Intro
                $feat.remove();
            else
                $('form#man-chapter').prepend('<input type="hidden" name="featurable" id="featureable" value="1">');

        });

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