<?php
    require_once(ROOT . DS . 'core' . DS . 'Controller.php');
    class Home extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
        }
        public function indexAction() {
            $this->view->render();
        }
    }