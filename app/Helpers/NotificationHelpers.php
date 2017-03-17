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
        return 'btn-link';
    else
        return 'btn-success disabled';
}

//Notification Icon
function NotificationIcon($type)
{
    if($type == 'contact')
        return 'fa-envelope';
}

//Notification Type
function NotificationType($type)
{
    if($type == 'contact')
        return true;

    return false;
}

//Notification Type
function NotificationRoute($type)
{
    if($type == 'contact')
        return 'admin.contact.message';
}