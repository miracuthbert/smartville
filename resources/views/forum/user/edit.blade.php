@extends('layouts.company.master')

@section('title')
    Knowledge Base - Edit Post
@endsection

@section('content')
    @include('partials.headers.home.primary')

    <section class="box" id="forumWrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-8">
                    <h1 class="page-header"><i class="fa fa-edit"></i> Edit Post</h1>
                    <form role="form" method="post" action="{{ route('forum.update', ['forum' => $topic->id]) }}"
                          enctype="multipart/form-data" id="forum-update-form">

                        @include('partials.alerts.default')

                        @include('partials.alerts.validation')

                        {{ method_field('put') }}

                        {{ csrf_field() }}

                        <div class="box">
                            <div class="form-group">
                                <label>Topic</label>
                                <input type="text" name="topic" class="form-control" id="topic" maxlength="255"
                                       value="{{ Request::old('topic') != null ? Request::old('topic') : $topic->title }}"
                                       required autofocus>
                            </div>
                        </div>

                        <div class="box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Tag</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#</span>
                                        <input type="text" class="form-control" id="tag" placeholder="tag">
                                    </div>
                                    <span class="help-block">Add tag then press enter</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Choose default tag</label>
                                    <select name="default-tags" class="form-control" id="default-tags">
                                        <option></option>
                                        @foreach($app_products as $app)
                                            <option value="{{ $app->title }}">{{ $app->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form-group">
                                <label>Tags</label>
                                <div id="tags">
                                    @forelse($_tags as $tag)
                                        <input type="hidden" name="tags[]"
                                               data-tag-id="{{ Request::old('tags') ? Request::old('tags')[$loop->index] : $tag->name }}"
                                               value="{{ Request::old('tags') ? Request::old('tags')[$loop->index] : $tag->name }}">
                                        <button type="button" class="btn btn-default btnTagRmv"
                                                data-tag-id="{{ Request::old('tags') ? Request::old('tags')[$loop->index] : $tag->name }}">
                                            {{ Request::old('tags') ? Request::old('tags')[$loop->index] : $tag->name }}
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    @empty
                                        <p class="help-block">No tags found</p>
                                    @endforelse
                                </div>
                                <span class="help-block">Tags you add will appear here. Click on tag to remove it.</span>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form-group">
                                <label>Details</label>
                            <textarea name="details" class="form-control ckeditor" id="details"
                                      rows="3">{{ Request::old('details') != null ? Request::old('details') : $topic->details }}</textarea>
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
                                    <input type="checkbox" name="answer_from_support"
                                           value="1" {{ $topic->is_support ? 'checked' : '' }}>Support
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="answer_from_community"
                                           value="1" {{ $topic->is_community ? 'checked' : '' }}>Community
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="answer_from_founder "
                                           value="1" {{ $topic->is_founder ? 'checked' : '' }}>Founder
                                </label>

                                <p class="help-block">Who do you want to answer the question</p>
                            </div>
                        </div>

                        <div class="box">
                            <button type="submit" class="btn btn-primary">
                                Update Post
                                <i class="fa fa-check-square-o"></i>
                            </button>
                            <button type="reset" class="btn btn-default">
                                Clear
                                <i class="fa fa-remove"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-9 -->
                <!-- support sidebar -->
                @include('partials.sidebars.knowbase-v1')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#forumWrapper -->

    <!-- modals -->
    @include('partials.modals.forum-delete');

    <!-- footer -->
    @include('partials.footers.default')
@endsection

@section('scripts')
    <script>

        var $form = $('form#forum-update-form');
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
        $('#default-tags').on('change', function () {
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