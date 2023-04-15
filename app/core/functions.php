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
