<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ url('js/jquery-2.2.1.min.js') }}"><\/script>')</script>

<!-- jQuery UI JavaScript -->
<script src="{{ url('js/vendor/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>

<!-- Custom Text Editor -->
<script src="{{ url('js/ckbasic/ckeditor.js') }}"></script>

@yield('scripts')

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ url('js/ie10-viewport-bug-workaround.js') }}"></script>
