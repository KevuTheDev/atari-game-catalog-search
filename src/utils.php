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

function print_error($error_message)
{
    print "<span class=\"error\">  " . $error_message . "</span>";
}

function value_output($columns, $index)
{
    $result = isset($columns);

    if ($result == true) {
        $result = isset($columns[$index]);
    }
    return ($result == true) ? $columns[$index] : "";
}