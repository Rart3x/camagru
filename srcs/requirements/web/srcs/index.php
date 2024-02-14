<?php
    session_start();
    define('DS', DIRECTORY_SEPARATOR);
    echo DS;
    define('ROOT', dirname(__FILE__));
    echo $_SERVER['PATH_INFO'];
    $url = isset($_SERVER['PATH_INFO']) ? explode ('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
?>