<?php
    class Login extends Controller {
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
                    ]
                ]);

                if ($validation->passed()) {
                    $user = $this->Users->findByUsername($_POST['userName']);
                    
                    if ($user && Input::get('password') == $user->userPass) { // Need to hash
                        $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                        $user->login($remember);
                        
                        Router::redirect('home');
                    } else
                        $validation->addError("Something went wrong with your Username or Password");
                }
            }
            $this->view->displayErrors = $validation->displayErrors();
            $this->view->render('login');
        }
    }