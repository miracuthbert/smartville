<?php
function cat_level($level)
{
    return $level == 1 ? 'Parent' : 'Child';
}

function cat_status($status)
{
    return $status == 1 ? 'Active' : 'Disabled';
}