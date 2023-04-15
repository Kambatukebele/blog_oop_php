<?php
class App
{
    private $controller = "home";
    private $method = "index";
    private $params;
    /**
     * HERE WE USE A CONSTRUCT TO DIRECTLY ACCESS THE APP
     * WE CALL THE FUNCTION GetURL() IN THE CONSTRUCT FUNCTION USING THE $THIS KEYWORD
     * WE VERIFY IF THE PAGE EXIST IN THE CONTROLLERS LOCATED IN THE APP FOLDER
     * IF THE PAGE EXISTS, WE REQUIRE IT, IF NOT, WE RETURN HOME
     * NOTE THAT EVERY PAGE ARE CLASS BASE CONTROLLERS AND THEY MUST EXIST, OTHERWHISE WE RETURN AN 404 PAGE
     * $URL[0] REPRESENT A PAGE CLASS IN THE CONTROLLERS, AND IT MUST EXIST
     * $URL[1] REPRESENT A METHOD INSIDE THE CLASS LOCATED IN CONTROLLERS FOLDER
     * $URL[3] REPRESENT PARAMS 
     */
    public function __construct()
    {
        $URL = $this->GetURL();
        $this->controller = $URL[0];
        $FILENAME = "../app/controllers/" . strtolower($this->controller) . ".php";

        if (file_exists($FILENAME)) {
            require $FILENAME;
            /**
             * AFTER REQUIRING THE FILE, WE SET $THIS->CONTROLLER = $URL[0];
             * AND THE WE MUST INSTATIATE THE CLASS CAPTURED IN THE $URL[0]
             */
            // $this->controller = $URL[0];
            unset($URL[0]);
        } else {
            $URL[0] = "_404";
            $FILENAME = "../app/controllers/" . strtolower($URL[0]) . ".php";
            require $FILENAME;
            $this->controller = $URL[0];
            unset($URL[0]);
        }

        //HERE WE INSTATIATE THE CLASS CAPTURED IN THE $URL[0]
        $this->controller = new $this->controller;

        //HERE WE VERIFY IF THE METHOD INSIDE THE CLASS CAPTURE IS SET
        if (isset($URL[1])) {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = $URL[1];
            }
        }

        unset($URL[1]);

        //HERE WE VERIFY IF THE PARAMS INSIDE THE CLASS CAPTURED THE REST OF THE URL, SO THAT WE CAN ADD ALL INTO AN ARRAY

        $this->params = (count($URL) > 0) ? $URL : ["home"];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * GET URL WITH THE GET SUPER GLOBAL
     * VERIFY IF URL IS SET? IF NOT, RETURN HOME PAGE
     * TRANSFORM URL TO AN ARRAY WITH THE EXPLODE FUNCTION
     */
    private function GetURL()
    {
        $GET_URL = isset($_GET['url']) ? $_GET['url'] : "Home";

        $GET_URL = explode('/', filter_var(trim($GET_URL, "/"), FILTER_SANITIZE_URL));
        return $GET_URL;
    }
}
