@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')

    @include('includes.headers.default')

    @include('includes.alerts.primary')

    <div class="jumbotron bg-green-sea white"><!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="container">

            <div class="text-center">
                <h1>Smart Ville</h1>

                <p>This is a template for a simple marketing or informational website. It includes a large callout
                    called a jumbotron and three supporting pieces of content. Use it as a starting point to create
                    something more unique.</p>
            </div>

        </div>
    </div>

    <!-- Main Services -->
    <section class="section" id="services">
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="ocl-lg-12 text-center">
                    <h1 class="sub-header">Products and Services</h1>
                    <hr>
                </div>

                <div class="col-md-4">
                    <section class="section-pad">
                        <h3>Rental Management System</h3>

                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor
                            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
                            magna
                            mollis euismod. Donec sed odio dui. </p>

                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </section>
                </div>
                <div class="col-md-4">
                    <section class="section-pad">
                        <h3>Hostel Management System</h3>

                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor
                            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
                            magna
                            mollis euismod. Donec sed odio dui. </p>

                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </section>
                </div>
                <div class="col-md-4">
                    <section class="section-pad">
                        <h3>Property Finder & Booking Service</h3>

                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum
                            id ligula
                            porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                            condimentum nibh,
                            ut fermentum massa justo sit amet risus.</p>

                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </section>
                </div>
            </div>

            <hr>

        </div> <!-- /container -->
    </section>

    <!-- Contacts -->
    <section class="section bg-wet-asphalt white" id="contacts">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section">
                        <h3>Location</h3>
                        <address class="section-lg">
                            <strong>ClockTower</strong>
                            <br>
                            <strong>Arusha, Tanzania</strong>
                        </address>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section">
                        <h3>Social Media</h3>
                        <ul class="list-inline">
                            <li><a href="#" class="btn-social btn-outline"><span class="icon icon-facebook"></span></a>
                            </li>
                            <li><a href="#" class="btn-social btn-outline"><span class="icon icon-twitter"></span></a>
                            </li>
                            <li><a href="#" class="btn-social btn-outline"><span class="icon icon-linkedin"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section">
                        <h3>About SmartVille</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.footers.default')

@endsection