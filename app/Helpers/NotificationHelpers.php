<?php

//Notification Read
function ToggleRead($date)
{
    if ($date == null)
        return 'Mark as read';
    else
        return 'Marked as read';
}

//Notification Read
function ToggleButtonRead($date)
{
    if ($date == null)
        return 'btn-success';
    else
        return 'btn-default disabled';
}

//Notification Icon
function NotificationIcon($type)
{
    if ($type == 'contact')
        return 'fa-envelope';
    if ($type == 'forum')
        return 'fa-comment';
    if ($type == 'bug')
        return 'fa-bug';
    if ($type == 'tenant bill')
        return 'fa-money';
    if ($type == 'subscription')
        return 'fa-credit-card-alt';
    if ($type == 'create_bill_invoices' || $type == 'tenant_bill_invoice')
        return 'fa-credit-card';
    if ($type == 'pending_bills_invoices')
        return 'fa-money';
    if ($type == 'pending_rent_invoices' || $type == 'tenant_rent_invoice')
        return 'fa-credit-card-alt';
    if ($type == 'activated_tenancy')
        return 'fa-edit';
}

//Notification Type
function NotificationType($type)
{
    if ($type == 'contact')
        return true;
    if ($type == 'forum')
        return true;

    return false;
}

//Notification Type
function NotificationRoute($type)
{
    if ($type == 'contact')
        return 'admin.contact.message';
    if ($type == 'forum')
        return 'forum.show';
    if ($type == 'bug')
        return 'bugs.show';
}

function NotificationUserRoute($notification, $user)
{
    $type = $notification->data['type'];

    if ($type == 'subscription') {
        return '#';
    } elseif ($type == 'forum') {    //create bill invoice route
        if ($notification->read_at != null) { //read route
            return route('forum.show', ['id' => $notification->data['id'], '#comment'.$notification->data['comment_id'], 'read' => $notification->id]);
        } else {    //not read route
            return route('forum.show', ['id' => $notification->data['id'], '#comment'.$notification->data['comment_id'], 'notify' => $notification->id]);
        }
    } elseif ($type == 'tenant_bill_invoice') {  //tenant bill invoice route
        if ($notification->read_at != null) { //read route
            return route('tenant.bill', ['id' => $notification->data['invoice_id']]);
        } else {    //not read route
            return route('tenant.bill', ['id' => $notification->data['invoice_id'], 'read' => $notification->id]);
        }
    } elseif ($type == 'tenant_rent_invoice') {  //tenant rent invoice route
        if ($notification->read_at != null) { //read route
            return route('tenant.rent', ['id' => $notification->data['rent_id']]);
        } else {    //not read route
            return route('tenant.rent', ['id' => $notification->data['rent_id'], 'read' => $notification->id]);
        }
    } elseif ($type == 'activated_tenancy') {  //activated tenancy route
        if ($notification->read_at != null) { //read route
            return route('tenant.dashboard', ['id' => $notification->data['tenant_id']]);
        } else {    //not read route
            return route('tenant.dashboard', ['id' => $notification->data['tenant_id'], 'read' => $notification->id]);
        }
    }
}

/**
 * Handles Notification Route
 *
 * @param $notification
 * @param $app
 * @return string
 */
function NotificationEstateRoute($notification, $app)
{
    $type = $notification->data['type'];

    if ($type == 'subscription') {
        return '#';
    } elseif ($type == 'create_bill_invoices') {    //create bill invoice route
        if ($notification->read_at != null) { //read route
            return route('rental.bills.generate', ['id' => $app->id, 'service' => $notification->data['billing_id']]);
        } else {    //not read route
            return route('rental.bills.generate', ['id' => $app->id, 'service' => $notification->data['billing_id'], 'notify' => $notification->id]);
        }
    } elseif ($type == 'pending_bills_invoices') {  //pending bills route
        if ($notification->read_at != null) {   //read route
            return route('rental.bills.index', ['id' => $app->id, 'sort' => 'pending', 'service' => $notification->data['billing_id'], 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]);
        } else {    //not read route
            return route('rental.bills.index', ['id' => $app->id, 'sort' => 'pending', 'service' => $notification->data['billing_id'], 'notify' => $notification->id, 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]);
        }
    } elseif ($type == 'pending_rent_invoices') { //pending rent routes
        if ($notification->read_at != null) { //notification read route
            return route('rental.rents.index', ['id' => $app->id, 'sort' => 'pending', 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]);
        } else {    //not read route
            return route('rental.rents.index', ['id' => $app->id, 'sort' => 'pending', 'notify' => $notification->id, 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]);
        }
    }
}