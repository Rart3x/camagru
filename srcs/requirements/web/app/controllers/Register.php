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
                        'min' => 6,
                        'max' => 10,
                        'required' => true,
                        'unique' => 'Users'
                    ],
                    'userMail' => [
                        'display' => 'Email',
                        'required' => true,
                        'valid_email' => true,
                        'unique' => 'Users'
                    ],
                    'userPass' => [
                        'display' => 'Password',
                        'min' => 6,
                        'required' => true
                    ],
                    'confirmPass' => [
                        'display' => 'Confirmation Password',
                        'matches' => 'userPass',
                        'min' => 6,
                        'required'=> true
                    ]
                ]);

                if ($validation->passed()) {
                    if ($_POST['userPass'] == $_POST['confirmPass']) {
                        $username = $_POST['userName'];
                        $email = $_POST['userMail'];
                        $password = password_hash($_POST['userPass'], PASSWORD_DEFAULT);
                        
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