<?php

class Category extends Controller
{
    public function index()
    {
        return $this->LOAD_VIEW("blog/category");
    }
}
