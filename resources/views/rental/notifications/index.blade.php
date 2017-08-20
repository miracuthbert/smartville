@extends('layouts.rental.master')

@section('title')
    Notifications
@endsection

@section('breadcrumb')
    <li class="active">Notifications</li>
@endsection

@section('page-header')
    <div class="clearfix">
        <i class="fa fa-bell fa-fw"></i> Notifications

        <div class="pull-right">
            <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-danger"
                   onclick="event.preventDefault(); document.getElementById('rental-notifications-destroy-form').submit();">Delete
                    All</a>

                <form id="rental-notifications-destroy-form"
                      action="{{ route('rental.notifications.destroy', [$app]) }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section id="notifications-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @forelse($_notifications as $notification)
                    @if($notification->data['type'] == "subscription")
                        @include('rental.notifications.partials._subscription', compact('notification'))
                    @elseif($notification->data['type'] === "create_bill_invoices")
                        @include('rental.notifications.partials._create_bill_invoice', compact('notification'))
                    @elseif($notification->data['type'] === "pending_bills_invoices")
                        @include('rental.notifications.partials._pending_bill_invoice', compact('notification'))
                    @elseif($notification->data['type'] === "pending_rent_invoices")
                        @include('rental.notifications.partials._pending_rent_invoice', compact('notification'))
                    @endif
                @empty
                    <p class="lead">You have no notifications.</p>
                @endforelse

                <div class="clearfix">
                    <p><strong>Total notifications: {{ $_notifications->total() }}</strong></p>
                    <hr>
                    {{ $_notifications->links()  }}
                </div>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </section>
@endsection