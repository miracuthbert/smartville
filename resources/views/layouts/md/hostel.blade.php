<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Hostel Management App is designed to provide more flexibility to manage hostels">
    <meta name="author" content="SmartVille, <support@smartville.com>">
    <link rel="icon" href="{{ url('images/site/cropped-sv_00-32x32.png') }}">

    <title>@yield('title') - Hostels | {{ config('app.name') }}</title>

    <!-- Main Fonts -->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400'>

    <!-- Vendor CSS -->
    <link href="{{ url('themes/modularadmin/css/vendor.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/vendor/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Theme initialization -->
    <script>
        var cssPath = "{{ url('themes/modularadmin/css') }}";
        var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
        {};
        var themeName = themeSettings.themeName || '';
        if (themeName) {
            document.write('<link rel="stylesheet" id="theme-style" href="' + cssPath + '/app-' + themeName + '.css">');
        }
        else {
            document.write('<link rel="stylesheet" id="theme-style" href="' + cssPath + '/app.css">');
        }
    </script>
    <!-- Your custom styles (optional) -->
    <link href="{{ url('css/hostel/style.css') }}" rel="stylesheet">
</head>

<body>

<div class="main-wrapper">
    <div class="app" id="app">
        @include('hostels.includes.headers.default')
        @include('hostels.includes.sidebars.default')
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <article class="content @yield('content-styles')">
            @yield('content')
        </article>
        @include('hostels.includes.footers.default')
        <div class="modal fade" id="modal-media">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Media Library</h4>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <ul class="nav nav-tabs modal-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
                            </li>
                        </ul>
                        <div class="tab-content modal-tab-content">
                            <div class="tab-pane fade" id="gallery" role="tabpanel">
                                <div class="images-container">
                                    <div class="row"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                <div class="upload-container">
                                    <div id="dropzone">
                                        <form action="/" method="POST" enctype="multipart/form-data"
                                              class="dropzone needsclick dz-clickable" id="demo-upload">
                                            <div class="dz-message-block">
                                                <div class="dz-message needsclick"> Drop files here or click to
                                                    upload.
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Insert Selected</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="confirm-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to do this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ url('js/vendor/tether.min.js') }}"></script>

<!-- Modular Admin JS -->
<script src="{{ url('themes/modularadmin/js/vendor.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ url('js/vendor/bootstrap.min.js') }}"></script>

<!-- Modular Admin JS -->
<script src="{{ url('themes/modularadmin/js/app.js') }}"></script>

<!-- Custom Text Editor -->
<script src="{{ url('js/ckbasic/ckeditor.js') }}"></script>

<!-- Hostel JS -->
<script src="{{ url('js/hostel/custom.js') }}"></script>

@yield('scripts')
</body>

</html>