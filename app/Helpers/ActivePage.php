<?php

function ActivePage($routeName)
{
    if($routeName == \Illuminate\Support\Facades\Route::currentRouteName()) {
        return 'active';
    }
}

function ActivePageDisable($routeName)
{
    if(route($routeName) == url()->full()) {
        return 'disabled';
    }
}

function checkPage($routeName)
{
    if($routeName == \Illuminate\Support\Facades\Route::currentRouteName()) {
        return true;
    }

    return false;
}

