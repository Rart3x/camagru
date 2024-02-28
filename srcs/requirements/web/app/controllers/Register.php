<?php
    class Register extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            $validation = new Validate();

            if ($_POST) {

                $validation->check($_POST, [
                    'userName' => [
                        'display' => 'Username',
                        'required' => true
                    ],
                    'password' => [
                        'display' => 'Password',
                        'required'=> true
                    ],
                    'confirmPass' => [
                        'display' => 'Confirmation Password',
                        'required'=> true
                    ]
                ]);
            }
            $this->view->displayErrors = $validation->displayErrors();
            $this->view->render('register');
        }
    }