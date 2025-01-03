<?php
defined('BASEPATH') or exit('No direct script access allowed');

function to_human($data)
{
    $old = date($data);
    $oldTimestamp = strtotime($old);
    $new = date('d M Y', $oldTimestamp);
    return $new;
}
