<?php
function dd($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function field($text)
{
    return trim(mysqli_real_escape_string($GLOBALS['conn'], htmlspecialchars($text)));
}

function query($query) {
    return mysqli_query($GLOBALS['conn'], $query);
}