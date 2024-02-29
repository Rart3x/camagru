<?php
    class Register extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            $db = DB::getInstance();
            $validation = new Validate();

            if ($_POST) {

                $validation->check($_POST, [
                    'userName' => [
                        'display' => 'Username',
                        'required' => true
                    ],
                    'email' => [
                        'display' => 'E-mail',
                        'required' => true,
                        'valid_email' => true
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

                if ($validation->passed()) {
                    if ($_POST['password'] == $_POST['confirmPass']) {
                        $username = $_POST['userName'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        
                        $sql = "INSERT INTO Users (userName, userMail, userPass, notifOn, linkValidated) VALUES (?, ?, ?, ?, ?)";
                        $params = [$username, $email, $password, 0, 0];
                        
                        $db->query($sql, $params);

                        Router::redirect('home');
                    }
                }
            }
            $this->view->displayErrors = $validation->displayErrors();
            $this->view->render('register');
        }
    }