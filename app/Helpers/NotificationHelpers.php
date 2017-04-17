<?php

//Notification Read
function ToggleRead($date)
{
    if($date == null)
        return 'Mark as read';
    else
        return 'Marked as read';
}

//Notification Read
function ToggleButtonRead($date)
{
    if($date == null)
        return 'btn-success';
    else
        return 'btn-default disabled';
}

//Notification Icon
function NotificationIcon($type)
{
    if($type == 'contact')
        return 'fa-envelope';
    if($type == 'forum')
        return 'fa-comment';
    if($type == 'bug')
        return 'fa-bug';
    if($type == 'tenant bill')
        return 'fa-money';
}

//Notification Type
function NotificationType($type)
{
    if($type == 'contact')
        return true;
    if($type == 'forum')
        return true;

    return false;
}

//Notification Type
function NotificationRoute($type)
{
    if($type == 'contact')
        return 'admin.contact.message';
    if($type == 'forum')
        return 'forum.show';
    if($type == 'bug')
        return 'bugs.show';
}