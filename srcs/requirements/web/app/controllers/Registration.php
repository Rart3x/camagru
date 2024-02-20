<?php
    class Registration extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            if (isset($_POST['userName']))
                $user = $this->Users->findByUsername($_POST['userName']);
            $this->view->render('registration');
            dnd($user);
        }
    }