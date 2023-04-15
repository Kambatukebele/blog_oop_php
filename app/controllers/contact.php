<?php

class Contact extends Controller
{
    public function index()
    {
        return $this->LOAD_VIEW("blog/contact");
    }
}
