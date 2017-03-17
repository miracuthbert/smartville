@extends('layouts.blank')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                <i class="glyphicon glyphicon-download"></i>
                Download in progress
            </h3>
        </div>
        <div class="panel-body">
            <p class="mute">If download does not start automatically...
                <a href="{{ route($downloadUrl) }}" class="btn btn-link">Click here to restart</a>
            </p>
        </div>
    </div>

@endsection