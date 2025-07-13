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
function random_code($length) {
    $str = '0123456789';
    $output = '';
    for($i = 0; $i < $length; $i++) {
        $output .= $str[rand(0, strlen($str) - 1)];
    }
    return $output;
}