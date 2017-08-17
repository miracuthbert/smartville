@extends('layouts.company.master')

@section('title')
    Contact Us
@endsection

@section('styles')
    <link href="{{ url('css/v1/contact.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section id="contact"><!-- Contact Section -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <hr class="star-primary">
                <h3 class="section-subheading text-muted">Leave us a message.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form method="post" action="{{ route('contact.send') }}" name="sentMessage" id="contactForm"
                      enctype="application/x-www-form-urlencoded">
                    {{ csrf_field() }}

                    @include('partials.alerts.default')

                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" id="name"
                                   required
                                   value="{{ old('name') != null ? old('name') : '' }}">
                            <p class="help-block text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address"
                                   id="email" required
                                   value="{{ Request::old('email') != null ? Request::old('email') : '' }}">
                            <p class="help-block text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number"
                                   id="phone" required
                                   value="{{ Request::old('phone') != null ? Request::old('phone') : '' }}">
                            <p class="help-block text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject"
                                   required
                                   value="{{ old('subject') != null ? old('subject') : '' }}">
                            <p class="help-block text-danger">{{ $errors->has('subject') ? $errors->first('subject') : '' }}</p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Message</label>
                                <textarea name="message" rows="5" class="form-control" placeholder="Message"
                                          id="message">{{ Request::old('message') != null ? Request::old('message') : '' }}</textarea>
                            <p class="help-block text-danger">{{ $errors->has('message') ? $errors->first('message') : '' }}</p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-send btn-block">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ url('js/freelancer.min.js') }}"></script>
@endsection
