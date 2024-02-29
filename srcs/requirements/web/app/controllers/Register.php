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
                        'required' => true,
                        'min' => 6
                    ],
                    'confirmPass' => [
                        'display' => 'Confirmation Password',
                        'required'=> true,
                        'matches' => 'userPass',
                        'min' => 6
                    ]
                ]);

                if ($validation->passed()) {
                    if ($_POST['userPass'] == $_POST['confirmPass']) {
                        $username = $_POST['userName'];
                        $email = $_POST['userMail'];
                        $password = $_POST['userPass'];
                        
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