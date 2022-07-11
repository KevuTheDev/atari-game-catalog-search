<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function pre_r($array)
{
    print "<pre>";
    print_r($array);
    print "</pre>";
}