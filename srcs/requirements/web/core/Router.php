<?php
    class Router {
        public static function route($url) {
            $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
            $controller_name = $controller;
            array_shift($url);

            $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
            $action_name = $controller;
            array_shift($url);

            $queryParams = $url;

            $dispatch = new $controller($controller_name, $action);

            if (method_exists($controller, $action))
                call_user_func_array([$dispatch, $action], $queryParams);
            else
                die("error: this method does not exist in the controller\"' . $controller_name . '\'");
        }
    }