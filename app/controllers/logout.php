<?php

class Logout
{
    public function index()
    {
        if (isset($_SESSION['userDetails'])) {
            unset($_SESSION['userDetails']);
        }
        header("Location: " . ROOT . "home");
        die;
    }
}