@if(Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}

        @if(Session::has('success_link'))
            <a href="{{ Session::get('success_link') }}" class="alert-link">{{ Session::get('success_link_name') }}</a>
        @endif
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('warning') }}

        @if(Session::has('warning_link'))
            <a href="{{ Session::get('warning_link') }}" class="alert-link">{{ Session::get('warning_link_name') }}</a>
        @endif
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('error') }}

        @if(Session::has('error_link'))
            <a href="{{ Session::get('error_link') }}" class="alert-link">{{ Session::get('error_link_name') }}</a>
        @endif
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('info') }}

        @if(Session::has('info_link'))
            <a href="{{ Session::get('info_link') }}" class="alert-link">{{ Session::get('info_link_name') }}</a>
        @endif
    </div>
@endif

@if(Session::has('bulk_error') && count(Session::get('bulk_error')) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach(collect(Session::get('bulk_error'))->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('bulk_success') && count(Session::get('bulk_success')) > 0)
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach(collect(Session::get('bulk_success'))->all() as $success)
                <li>{{ $success }}</li>
            @endforeach
        </ul>
    </div>
@endif