<?php

//topic status label
function TopicStatusLabel($status)
{
    $status = $status != 'null' ? 'label label-danger' : 'label label-success';

    $label = $status;

    return $label;
}

//topic status text
function TopicStatusText($status)
{
    $status = $status != 'null' ? 'Closed' : 'Active';

    $label = $status;

    return $label;
}

//topic status toggle text
function TopicStatusIcon($status)
{
    $status = $status != 'null' ? 'fa fa-lock' : 'fa fa-unlock';

    $label = $status;

    return $label;
}

//topic status toggle text
function TopicToggleText($status)
{
    $status = $status == 'null' ? 'Closed' : 'Active';

    $label = $status;

    return $label;
}

//topic status toggle text
function ForumSubHeader($sort, $user)
{
    $label = 'Posts by date(latest)';

    switch ($sort) {
        case "user":
            $fn = $user->firstname;

            $user = $user->lastname . ' ' . $fn;

            $label = Auth::user()->firstname == $fn ? ' My Posts' : 'Posts Author: <small>' . $user . '</small>';

            return $label;

        default:
            return $label;
    }
}

function ForumSubHeaderIcon($sort, $user)
{
    $label = 'Posts by date(latest)';

    switch ($sort) {
        case "user":
            $fn = $user->firstname;

            $user = $user->lastname . ' ' . $fn;

            $label = Auth::user()->firstname == $fn ? 'fa fa-user' : '';

            return $label;

        default:
            return $label;
    }
}