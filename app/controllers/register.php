<?php

class Register extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->LOAD_MODEL("Users");
            $resultModel = $userModel->REGISTER($_POST);

            if (!empty($resultModel)) {
                $data['errors'] = $resultModel;
            }
        }

        $data['page_title'] = "Register";
        return $this->LOAD_VIEW("blog/register", $data);
    }
}