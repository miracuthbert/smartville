@extends('layouts.md.hostel')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">

        <!-- Section: Stats -->
        <div class="divider-new">
            <h2 class="h2-responsive wow fadeInDown">Stats</h2>
        </div>

        <section id="stats">
            <div class="row">
                <!--First columnn-->
                <div class="col-lg-3">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.4s">

                        <!--Card content-->
                        <div class="card-block">
                            <!--Title-->
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <h3 class="h3-responsive">10</h3>
                                        <p class="lead">
                                            Pending Rent
                                        </p>
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.card-title -->
                            <!--Text-->
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="#" class="btn btn-info btn-block">View All</a>
                        </div>
                        <!--/.Card content-->

                    </div>
                    <!--/.Card-->
                </div>
                <!--First columnn-->

                <!--Second columnn-->
                <div class="col-lg-3">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.6s">

                        <!--Card content-->
                        <div class="card-block">
                            <!--Title-->
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <h3 class="h3-responsive">10</h3>
                                        <p class="lead">
                                            Pending Bills
                                        </p>
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.card-title -->
                            <!--Text-->
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="#" class="btn btn-info btn-block">View All</a>
                        </div>
                        <!--/.Card content-->

                    </div>
                    <!--/.Card-->
                </div>
                <!--Second columnn-->

                <!--Third columnn-->
                <div class="col-lg-3">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.8s">

                        <!--Card content-->
                        <div class="card-block">
                            <!--Title-->
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-calendar-plus-o fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <h3 class="h3-responsive">10</h3>
                                        <p class="lead">
                                            Reservations
                                        </p>
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.card-title -->
                            <!--Text-->
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="#" class="btn btn-info btn-block">View All</a>
                        </div>
                        <!--/.Card content-->

                    </div>
                    <!--/.Card-->
                </div>
                <!--Third columnn-->

                <!--Fourth columnn-->
                <div class="col-lg-3">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.8s">

                        <!--Card content-->
                        <div class="card-block">
                            <!--Title-->
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-warning fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <h3 class="h3-responsive">10</h3>
                                        <p class="lead">
                                            Issues
                                        </p>
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.card-title -->
                            <!--Text-->
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="#" class="btn btn-info btn-block">View All</a>
                        </div>
                        <!--/.Card content-->

                    </div>
                    <!--/.Card-->
                </div>
                <!--Fourth columnn-->
            </div><!--/.row-->
        </section><!-- /#stats -->

        <!-- Section: Pending -->
        <section id="pending">
            <div class="row">
                <div class="col-sm-4">
                    <div class="divider-new">
                        <h4 class="h4-responsive wow fadeInDown"><i class="fa fa-credit-card"></i> Pending Rent</h4>
                    </div>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-bed"></i> Bed</h5>
                                <small>3 days ago</small>
                                <span class="badge badge-warning">$.30</span>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small>Donec id elit non mi porta.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-home"></i> Room</h5>
                                <small class="text-muted">3 days ago</small>
                                <span class="badge badge-warning">$.100</span>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small class="text-muted">Donec id elit non mi porta.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-bed"></i> Bed </h5>
                                <small class="text-muted">3 days ago</small>
                                <span class="badge badge-warning">$.25</span>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small class="text-muted">Donec id elit non mi porta.</small>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="divider-new">
                        <h4 class="h4-responsive wow fadeInDown"><i class="fa fa-money"></i> Bills</h4>
                    </div>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-cutlery"></i> John Doe</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small>Donec id elit non mi porta.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-television"></i> Mary Ann</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small class="text-muted">Donec id elit non mi porta.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-bus"></i> Jane Doe</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small class="text-muted">Donec id elit non mi porta.</small>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="divider-new">
                        <h4 class="h4-responsive wow fadeInDown"><i class="fa fa-calendar-check-osr"></i> Booking Approvals</h4>
                    </div>

                </div>
            </div>
        </section>

    </div><!-- /.container -->
@endsection