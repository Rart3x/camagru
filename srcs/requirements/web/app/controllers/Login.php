<?php
    class Login extends Controller {
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->load_model('Users');
        }

        public function indexAction() {
            if (isset($_POST['userName']))
                $user = $this->Users->findByUsername($_POST['userName']);
                if ($user && Input::get('password') == $user->userPass) {
                $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                $user->login($remember);
                Router::redirect('home');
            }
            $this->view->render('login');
        }
    }