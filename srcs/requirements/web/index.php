<?php
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__FILE__));

    require_once(ROOT . DS . 'config' . DS. 'config.php');
    require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

    spl_autoload_register( function($className) {
        $searchPaths = [
            ROOT . DS . "core" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "controllers" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "models" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "views" . DS . $className . ".php",
        ];
    
        foreach($searchPaths as $i)
            if(file_exists($i))
                require_once($i);
    });

    require_once(ROOT . DS . 'app' . DS . 'models' . DS . 'Users.php');

    session_start();

    $url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'], '/')) : [];

    Router::route($url);

    $db = DB::getInstance();
    $db->query('INSERT INTO `Users` (`userId`, `userName`, `userMail`, `userPass`, `notifOn`, `linkValidated`) VALUES (1, "kramjatt", "kramjatt@42.fr", "test", 0, 0);');