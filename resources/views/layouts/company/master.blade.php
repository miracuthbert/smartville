<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.company.partials._head')
    </head>

    <body>
        @include('partials.headers.home.primary')

        <div class="container">
            @yield('content')
        </div>

        @include('partials.footers.default')

        @include('partials.modals.success-modal')
        @include('partials.modals.error-modal')

        @include('layouts.company.partials._scripts')
    </body>
</html>