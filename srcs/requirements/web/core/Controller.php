<?php
    require_once(ROOT . DS . 'core' . DS . 'Application.php');
    class Controller extends Application {
        protected $_controller, $_action;
        public $view;
        public function __construct($controller, $action) {
            parent::__construct();
            $this->_controller = $controller;
            $this->_action = $action;
            $this->view = new View();
        }

        protected function load($model) {
            if (class_exists($model)) {
                echo "Model $model exists";
                $this->{$model.'Model'} = new $model(strtolower($model));
            }
        }

    }