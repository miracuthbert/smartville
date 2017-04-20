@extends('layouts.admin')

@section('title')
    {{ $manual->title }} Manual
@endsection

@section('breadcrumb')
    <li>Documentation</li>
    <li>Manual</li>
    <li class="active">{{ $manual->title }}</li>
@endsection

@section('page-header')
    {{ $manual->title }} Manual
    <div class="pull-right">
        @include('v1.admin.documentation.manual.chapter_options')
        <!-- chapter options -->
        <a href="{{ route('manual.edit', ['manual' => $manual->id]) }}" class="btn btn-primary btn-sm">
            Edit <i class="fa fa-edit"></i>
        </a>
        <!-- manual options -->
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    {!! $manual->body !!}
                </div>
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

        CKEDITOR.replace('ckeditor');
    </script>
@endsection