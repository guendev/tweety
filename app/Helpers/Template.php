<?php

function current_user(){
    return auth()->user();
}

/**
 * Format text.
 *
 * @param  string  $urlString
 * @return string
 */
function web_asset($urlString) {
    $v = '2';
    return asset($urlString) . '?v=' . $v;
}

