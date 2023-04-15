    <?php

    $HTTP_HOST = $_SERVER['HTTP_HOST'];
    $SERVER_NAME = $_SERVER['SERVER_NAME'];
    $HTTP = $_SERVER['REQUEST_SCHEME'];

    //CREATING SOME RELATIVE LINKS
    define("ROOT", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/");
    define("ROOT_ASSETS", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/assets/");

    //DB_CONNECTION CONSTANTS
    define("DB_HOST", $_SERVER['SERVER_NAME']);
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "blog_oop_php");
    define("DB_TYPE", "mysql");
