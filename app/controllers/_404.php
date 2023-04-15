<?php

class _404 extends Controller
{
    public function index()
    {
        return $this->LOAD_VIEW("blog/404");
    }
}
