<?php

function role_table_check($table, $role_tables) {
    return array_search($table, !empty($role_tables) ? $role_tables : array()) ? 'checked' : '';
}

/**
 * @param $solved_at
 * @return string
 */
function bug_label($solved_at)
{
    return empty($solved_at) ? 'label label-danger' : 'label label-success';
}

/**
 * @param $solved_at
 * @return string
 */
function bug_button_state($solved_at)
{
    return !empty($solved_at) ? 'btn-success' : 'btn-default';
}

function bug_button_text($solved_at)
{
    return !empty($solved_at) ? 'Mark as Pending' : 'Mark as Solved';
}

/**
 * @param $solved_at
 * @return string
 */
function bug_text($solved_at)
{
    return empty($solved_at) ? 'pending' : 'solved';
}

/**
 * @param $solved_at
 * @return string
 */
function bug_solved_date($solved_at)
{
    return empty($solved_at) ? '-' : $solved_at->toDayDateTimeString();
}

/**
 * @param $bug
 * @return bool
 */
function bug_feature($bug)
{
    return !empty($bug->buggable) ? !empty($bug->buggable->feature) ? $bug->buggable->feature : !empty($bug->buggable->title) : $bug->buggable->title;
}