<?php
defined('BASEPATH') or exit('No direct script access allowed');

function to_human($data)
{
    $old = date($data);
    $oldTimestamp = strtotime($old);
    $new = date('d M Y', $oldTimestamp);
    return $new;
}

function interval($dateStart, $dateEnd)
{
    $start = new DateTime($dateStart);
    $end = new DateTime($dateEnd);

    $interval = $start->diff($end);
    $days = $interval->days;
    return $days;
}

// (01 Jan 2025) -> 2025-01-01
function convertToDateFormat($dateString)
{
    $date = DateTime::createFromFormat('d M Y', $dateString);
    return $date->format('Y-m-d');
}

function dateRange()
{
    $first = date('Y-m-01');
    $last = date('Y-m-t');
    return ['first' => $first, 'last' => $last];
}
