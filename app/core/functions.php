<?php

function showPrint($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function showDump($stuff)
{
    echo "<pre>";
    var_dump($stuff);
    echo "</pre>";
}


//REMEMBER INPUTS ENTRY
function REMEMBER_INPUTS($key, $default = "")
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }

    return $default;
}