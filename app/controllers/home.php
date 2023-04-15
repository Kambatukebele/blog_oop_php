<?php

class Home extends Controller
{
    public function index()
    {
        return $this->LOAD_VIEW("blog/home");
    }
}
