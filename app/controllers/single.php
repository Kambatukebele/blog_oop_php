<?php

class Single extends Controller
{
    public function index()
    {
        return $this->LOAD_VIEW("blog/single");
    }
}
