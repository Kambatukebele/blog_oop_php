<?php

class Controller
{
    public function LOAD_VIEW(string $view, array $data = [])
    {
        $fileName = "../app/views/" . $view  . ".view.php";
        if (file_exists($fileName)) {
            include $fileName;
        } else {
            $fileName = "../app/views/404.view.php";
            include $fileName;
        }
    }

    protected function LOAD_MODEL(string $model)
    {
        $fileName = "../app/models/" . $model . ".model.php";
        if (file_exists($fileName)) {
            include $fileName;

            return $model = new $model();
        }

        return false;
    }
}
