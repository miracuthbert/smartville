@extends('v1.layouts.dashboard')

@section('title')
    Support - Bug Report
@endsection

@section('page-header')
    Bug Report
@endsection

@section('content')
    <section id="forumWrapper">
        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="post" action="{{ route('bug.store') }}" enctype="multipart/form-data"
                      id="complaint-create-form" autocomplete="off">

                    @include('includes.alerts.default')

                    @include('includes.alerts.validation')

                    {{ csrf_field() }}

                    <div class="box">
                        <div class="form-group">
                            <label>Bug</label>
                            <input type="text" name="bug" class="form-control" id="bug" maxlength="255"
                                   placeholder="bug" value="{{ Request::old('bug') }}" required autofocus>
                        </div>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>App feature</label>
                                    <select name="app_feature" class="form-control" id="app_feature">
                                        <option>Select buggy feature</option>
                                        @foreach($app_products as $app)
                                            <optgroup label="{{ $app->title }}">
                                                @foreach($app->features()->where('status', 1)->get() as $feature)
                                                    <option value="{{ $feature->id }}"
                                                            {{ $feature->id == Request::old('app_feature') ? 'selected' : '' }}>
                                                        {{ $feature->feature }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <p class="help-block">* Select an app feature that is buggy</p>
                        </div>
                    </div>

                    <div class="box">
                        <div class="form-group">
                            <label>Details</label>
                            <textarea name="details" class="form-control ckeditor" id="details"
                                      rows="5">{{ Request::old('details') }}</textarea>
                        </div>
                    </div>

                    <div class="box hidden">
                        <div class="form-group">
                            <label>Attach file</label>
                            <input type="file" name="file" class="form-control" id="file">
                            <p class="help-block">You can attach a file for more details</p>
                        </div>
                    </div>

                    <div class="box">
                        <button type="submit" class="btn btn-primary">
                            Send report
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
    </section>
@endsection

@section('scripts')
    <script>

        var $form = $('form#forum-create-form');
        var $submit = $form.find('button');

        //init
        $x = 0;

        //add tag function
        $addTag = function ($tag, $x) {

            if ($tag == "")
                return;

            $check = $('div#tags').find('button[data-tag-id="' + $tag + '"]');

            console.log($check.length);
            if ($check.length == 0) {
                //increment
                $x = $x++;

                //create tag
                $_tag = '<button type="button" class="btn btn-default btnTagRmv" ';
                $_tag += 'data-tag-id="' + $tag + '">';
                $_tag += $tag;
                $_tag += ' <i class="fa fa-times-circle"></i>';
                $_tag += '</button>';

                //create tag input
                $newTag = '<input type="hidden" name="tags[]" ';
                $newTag += 'data-tag-id="' + $tag;
                $newTag += '" value="' + $tag + '">';

                //append
                $('#tags').append($newTag);
                $('#tags').append($_tag);
            }
        };

        //add tag on select
        $('#app').on('change', function () {
            $this = $(this);

            //value
            $tag = $this.val();

            //create tag
            $addTag($tag, $x)

            $this.prop('selectedIndex', 0);
        });

        //add tag on text input
        $('#tag').on('focus', function (e) {
            $this = $(this);

            //on keydown
            $('#tag').on('keydown', function (a) {
                //check if tag is not null and key pressed is 'enter'
                if (a.key === "Enter") {
                    $this.prop('disabled', true);

                    //value
                    $tag = $this.val();

                    //form submit button disable
                    $submit.prop('disabled', true);

                    //create tag
                    if ($tag != "")
                        $addTag($tag, $x);

                    //form submit button enable
                    setTimeout(function () {
                        $this.val('');
                        $this.prop('disabled', false);
                        $submit.prop('disabled', false);
                    }, 1500);

                }
            });
        });

        //tag remove
        $(document).on('click', '.btnTagRmv', function () {
            $this = $(this);

            //add active class
            $this.addClass('active');

            //get id
            $id = $this.attr('data-tag-id');

            //remove input and its tag
            $this.remove();
            $('input[data-tag-id="' + $id + '"]').remove();
        });

        CKEDITOR.replace('ckeditor');
    </script>
@endsection
