<?php
    class Registration extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            $this->view->render('registration');
        }
    }