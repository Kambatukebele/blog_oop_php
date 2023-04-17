<?php

class User_dashboard extends Controller
{
    public function index()
    {
        $data['page_title'] = "Dashboard";
        return $this->LOAD_VIEW("dashboard/user_dashboard/user_dashboard", $data);
    }
}