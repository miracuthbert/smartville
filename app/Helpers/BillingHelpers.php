<?php

//bulk delete action route
function RentDeleteRoute($sort)
{
    if ($sort != 'trashed')
        return 'estate.rental.rent.delete';
    else
        return 'estate.rental.rent.destroy';
}

//bulk delete action route
function BillDeleteRoute($sort)
{
    if ($sort != 'trashed')
        return 'estate.rental.bills.invoice.delete';
    else
        return 'estate.rental.bills.invoice.destroy';
}

//Bill Units Calculate
function BillTotalUnits($previous, $current)
{
    $units = $current - $previous;

    return $units;
}

//Bill Calculate
function BillTotal($previous, $current, $charge)
{
    $units = $current - $previous;

    $total = $charge * $units;

    return $total;
}

//bill status text
function BillStatusText($status)
{
    if ($status == 1) {
        echo 'Paid';
    } else {
        echo 'Pending';
    }
}

//bill status text
function BillStatusClass($status)
{
    if ($status == 1) {
        echo 'paid';
    } else {
        echo 'pending';
    }
}

//bill dependency text
function BillPlan($status)
{
    if ($status == 1) {
        echo 'Continous';
    } else {
        echo 'Fixed';
    }
}

//auto billing text
function AutoBilling($status)
{
    if ($status == 1) {
        echo 'Yes';
    } else {
        echo 'No';
    }
}

//billing properties text
function BillingProperties($status)
{
    if ($status == 1) {
        echo 'All';
    } else {
        echo 'Selected';
    }
}