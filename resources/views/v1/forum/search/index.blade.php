@extends('layouts.company')

@section('title')
    Knowledge Base
@endsection

@section('styles')
    <style>
        #forumWrapper .jumbotron {
            background-color: #2C3E50;
            color: #EEEEEE;
        }

        #forumWrapper #topics {
            padding: 20px;
        }

        #forumWrapper #topics .topicWrapper {
            background-color: #f8f8f8;
            padding: 15px;
            margin-bottom: 30px;
            border: 1px solid #ECF0F1;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #topics .topicWrapper .levelWrapper span {
            margin-right: 15px;
        }

        #forumWrapper #forumFooter {
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-top: 1px solid #cccccc;
        }

    </style>
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <div id="forumWrapper">
        <div class="container">
            <div class="box" id="topics">
                <div class="row">
                    <div class="col-lg-9 col-sm-8">
                        @if($keyword == "tags")
                            @include('v1.forum.search.tags')
                        @else
                            @include('v1.forum.search.default')
                        @endif
                    </div>
                    <!-- /.col-lg-9 -->
                    <!-- support sidebar -->
                    @include('includes.sidebars.knowbase-v1')
                </div>
                <!-- /.row -->
            </div>
            <!-- /#topics -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#forumWrapper -->

    <!-- modals -->
    @include('includes.modals.forum-delete');

    <!-- footer -->
    @include('includes.footers.default')
@endsection
