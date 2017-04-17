{{--<footer id="footer">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-3 col-sm-6">--}}
                {{--<h4>Get help</h4>--}}
                {{--<ul>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('support.index') }}">Support</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('forum.index') }}">Knowledge Base</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('manuals.index') }}">Documentation</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('forum.create') }}">Ask a question</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<hr class="hidden-md hidden-lg hidden-sm">--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-sm-6">--}}
                {{--<h4>Apps and Services</h4>--}}
                {{--<ul>--}}
                    {{--@forelse($app_products as $product)--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('service', ['id' => $product->id]) }}">{{ $product->title }}</a>--}}
                        {{--</li>--}}
                    {{--@empty--}}
                        {{--<li>Something went wrong, try to refresh page</li>--}}
                    {{--@endforelse--}}
                {{--</ul>--}}

                {{--<hr class="hidden-md hidden-lg hidden-sm">--}}

                {{--<h5>Coming Soon</h5>--}}
                {{--<ul>--}}
                    {{--@forelse($apps_coming as $product)--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('service', ['id' => $product->id]) }}">{{ $product->title }}</a>--}}
                        {{--</li>--}}
                    {{--@empty--}}
                        {{--<li>Sign Up for a newsletter to receive updates.</li>--}}
                    {{--@endforelse--}}
                {{--</ul>--}}
                {{--<hr class="hidden-md hidden-lg hidden-sm">--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-sm-6">--}}
                {{--<h4>User Section</h4>--}}
                {{--<ul>--}}
                    {{--@if(!Auth::check())--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('login') }}">Login</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('register') }}">Sign Up</a>--}}
                        {{--</li>--}}
                    {{--@else--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('user.dashboard') }}">My dashboard</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('user.profile') }}">Profile</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
                {{--<hr class="hidden-md hidden-lg hidden-sm">--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-sm-6">--}}
                {{--<h4>Pages</h4>--}}
                {{--<ul>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('about') }}">About</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('contact') }}">Go to contact page</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}

<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <a href="{{ route('support.index') }}">Support</a> |
                <a href="{{ route('forum.index') }}">Knowledge Base</a> |
                <a href="{{ route('manuals.index') }}">Documentation</a> |
                <a href="{{ route('forum.create') }}">Ask a question</a>
                </ul>
            </div>
            <div class="col-lg-4">
                <p class="text-right text-center-xs">
                    &copy; {{ date('Y') }} {{ config('app.name') }}, Inc.
                </p>
            </div>
        </div>
    </div>
</section>