<?php
defined('BASEPATH') or exit('No direct script access allowed');

function toIcon($html = null)
{
    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);

    $element = $dom->getElementsByTagName('i')->item(0);
    if (!empty($element)) {
        $class = $element->getAttribute('class');
        if (!empty($class)) {
            $result = $class;
        }
    }
    return $result;
}
