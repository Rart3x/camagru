<?php
    require_once(ROOT . DS . 'config' . DS. 'config.php');
    require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

    spl_autoload_register( function($className) {
        $searchPaths = [
            ROOT . DS . "core" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "controllers" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "views" . DS . $className . ".php",
            ROOT . DS . "app" . DS . "models" . DS . $className . ".php"
        ];
    
        foreach($searchPaths as $i)
            if(file_exists($i))
                require_once($i);
    });
    
    Router::route($url);