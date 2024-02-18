<?php
    class Registration extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            // $this->load('Users');
        }

        public function indexAction() {
            // if ($_POST)
            //     $user = $this->UsersModel->findByUsername($_POST['userName']);
            $this->view->render('registration');
        }
    }