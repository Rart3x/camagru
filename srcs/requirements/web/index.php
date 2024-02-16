<?php
    session_start();

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__FILE__));

    $url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'], '/')) : [];

    require_once(ROOT . DS . 'core' . DS . 'boostrap.php');

    $db = DB::getInstance();