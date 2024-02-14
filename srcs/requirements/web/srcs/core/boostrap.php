<?php
    require_once(ROOT . DS . 'config' . DS. 'config.php');
    require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

    spl_autoload_register(function ($className) {
        $filePath = '';

        if (file_exists(ROOT . DS . 'core' . DS . $className . '.php'))
            $filePath = ROOT . DS . 'core' . DS . $className . '.php';
         elseif (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php'))
            $filePath = ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php';
        elseif (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php'))
            $filePath = ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php';
    
        if ($filePath !== '')
            require_once($filePath);
    });
    
    Router::route($url);
?>