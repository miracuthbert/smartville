<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}, Inc.</p>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('support.index') }}" class="btn btn-link">Support</a> |
                <a href="{{ route('questions.create') }}" class="btn btn-link">Ask a question</a> |
                <a href="{{ route('contact') }}" class="btn btn-link">Reach Us</a>
            </div>
        </div>
    </div>
</footer>