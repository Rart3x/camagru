<?php
    class Logout extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            if (currentUser())
                currentUser()->logout();
            Router::redirect('login'); 
        }
    }