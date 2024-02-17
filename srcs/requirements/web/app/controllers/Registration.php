<?php
    class Registration extends Controller {
        public function __construct($controller, $action) {
            $this->load->model("Users");
            parent::__construct($controller, $action);
        }

        public function indexAction() {
            if ($_POST) {
                $user = $this->UsersModel->findByUsermae($_POST['userName']);
            }
            $this->view->render('registration');
        }
    }