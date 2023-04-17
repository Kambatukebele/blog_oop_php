<?php

class Login extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userModel = $this->LOAD_MODEL("Users");
            $resultModel = $userModel->LOGIN($_POST);

            if (!empty($resultModel)) {
                $data['errors'] = $resultModel;
            }

            showPrint($resultModel);
        }
        $data['page_title'] = 'Login';
        return $this->LOAD_VIEW('blog/login', $data);
    }
}