@extends('v1.layouts.dashboard')

@section('title')
    Support - Ask Question
@endsection

@section('page-header')
    <i class="fa fa-question-circle-o"></i>
    I want to know about
    </span>
@endsection

@section('content')

    <div id="supportWrapper">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post" action="{{ route('questions.store') }}" enctype="multipart/form-data">

                    @include('includes.alerts.default')

                    @include('includes.alerts.validation')

                    {{ csrf_field() }}

                    <div class="box">
                        <div class="form-group">
                            <label>Topic</label>
                            <input type="text" name="topic" class="form-control" id="topic" placeholder="question topic">
                        </div>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <label>Details</label>
                            <textarea name="details" class="form-control ckeditor" id="details" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <label>Attach file</label>
                            <input type="file" name="file" class="form-control" id="file">
                            <p class="help-block">You can attach a file for more details</p>
                        </div>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <label>Answer from</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="answer-level[]" value="support" checked>Support
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="answer-level[]" value="community">Community
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="answer-level[]" value="founder">Founder
                            </label>

                            <p class="help-block">Who do you want to answer the question</p>
                        </div>
                    </div>

                    <div class="box">
                        <button type="submit" class="btn btn-primary">
                            Submit Question
                            <i class="fa fa-check-square-o"></i>
                        </button>
                        <button type="reset" class="btn btn-default">
                            Clear
                            <i class="fa fa-remove"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
