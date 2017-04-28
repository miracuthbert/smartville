<?php

function AppStatusClass($status)
{
    if ($status == 1) {
        echo 'label label-primary';
    } else {
        echo 'label label-warning';
    }
}

function AppStatusIcon($status)
{
    if ($status == 1) {
        echo 'fa fa-toggle-on';
    } else {
        echo 'fa fa-toggle-off';
    }
}

function PayStatusIcon($status)
{
    if ($status == 1) {
        echo 'fa fa-thumbs-up';
    } else {
        echo 'fa fa-money';
    }
}

function PayStatusLabel($status)
{
    if ($status == 1) {
        echo 'label label-success';
    } else {
        echo 'label label-warning';
    }
}

function PayStatusText($status)
{
    if ($status == 1) {
        echo 'Paid';
    } else {
        echo 'Pending';
    }
}

function AppStatusButton($status)
{
    if ($status == 1) {
        echo 'btn btn-primary';
    } else {
        echo 'btn btn-warning';
    }
}

function AppStatusToggle($status)
{
    if ($status == 1) {
        echo 'btn btn-warning';
    } else {
        echo 'btn btn-primary';
    }
}

function AppStatusText($status)
{
    if ($status == 1) {
        echo 'Active';
    } else {
        echo 'Disabled';
    }
}

function AppStatusToggleText($status)
{
    if ($status == 1) {
        echo 'Disable';
    } else {
        echo 'Activate';
    }
}

//property status text
function PropertyStatusText($status)
{
    if ($status == 1) {
        echo 'Occupied';
    } else {
        echo 'Vacant';
    }
}

//property status text
function PropertyStatusLabel($status)
{
    if ($status == 1) {
        echo 'label label-success';
    } else {
        echo 'label label-default';
    }
}

//lease status text
function LeaseStatusText($status)
{
    if ($status == 1) {
        echo 'Active';
    } else {
        echo 'Vacated';
    }
}

//rent status text
function RentStatusText($status)
{
    if ($status == 1) {
        echo 'Paid';
    } else {
        echo 'Pending';
    }
}

//rent status class
function RentStatusClass($status)
{
    if ($status == 1) {
        echo 'paid';
    } else {
        echo 'pending';
    }
}

//rent month name display text
function MonthName($date)
{
    $month = date('M', strtotime($date));
    echo $month;
}

//rent month name return text
function MonthNameReturn($date)
{
    $month = date('M', strtotime($date));
    return $month;
}

function AppModeText($mode)
{
    if ($mode == 1) {
        echo 'Production';
    } else {
        echo 'Development';
    }
}

function AppModeInfo($mode)
{
    if ($mode == 1) {
        return null;
    } else {
        echo 'App is under going development. Some features may be buggy. You can report whenever a problem occurs.';
    }
}

function AppDashRoute($product)
{
    if ($product == "Rental Management App") {
        return 'estate.rental.dashboard';
    }
}