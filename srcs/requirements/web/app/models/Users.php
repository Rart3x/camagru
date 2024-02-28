<?php
    class Users extends Model {
        private $_isLoggedIn, $_sessionName, $_cookieName, $_userName;
        public static $currentLoggedInUser = null;

        public function __construct($user='') {
            $table = 'Users';
    
            parent::__construct($table);
    
            $this->_sessionName = CURRENT_USER_SESSION_NAME;
            $this->_cookieName = REMEMBER_ME_COOKIE_NAME;

            if ($user != '') {
                if (is_int($user))
                    $u = $this->_db->findFirst('Users', ['conditions' => 'userId = ?', 'bind' => [$user]]);
                else
                    $u = $this->_db->findFirst('Users', ['conditions' => 'userName = ?', 'bind' => [$user]]);
           }
           if ($u)
                foreach ($u as $key => $val)
                    $this->$key = $val;
        }

        public static function currentLoggedInUser() {
            $U = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $U;
            return self::$currentLoggedInUser;
        }

        public function findByUsername($username) {
            return $this->findFirst(['conditions' => "userName = ?", 'bind' => [$username]]);
        }

        public function login($rememberMe = false, $username) {
            Session::set($this->_sessionName, $this->id);
            $this->_userName = $username;

            if ($rememberMe) {
                $hash = md5(uniqid() + rand(0, 100));
                $user_agent = Session::userAgent();
                
                Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);

                $U = $this->findFirst(['conditions' => "userName = ?", 'bind' => [$username]]);
                
                $fields = ['userId' => $U->userId, 'userSession' => $hash, 'userAgent' => $user_agent];

                $this->_db->query("DELETE FROM UserSessions WHERE userId = ? AND userAgent = ?", [$U->userId, $user_agent]);
                $this->_db->insert('UserSessions', $fields);
            } 
        }

        public static function loginUserFromCookie() {
            $userSession = UserSessions::getFromCookie();

            if ($userSession->userId != '')
                $user = new self((int)$userSession->userId);
            if ($user)
                $user->login();
            
            return $user;
        }

        public function logout() {
            $user_agent = Session::userAgent();

            $U = $this->findFirst(['conditions' => "userName = ?", 'bind' => [$this->_userName]]);

            echo $this->_userName . " : " . $U->userId;

            $this->_db->query("DELETE FROM UserSessions WHERE userId = ? AND userAgent ?", [$U->userId, $user_agent]);

            Session::delete(CURRENT_USER_SESSION_NAME);

            if (Cookie::exists(REMEMBER_ME_COOKIE_NAME))
                Cookie::delete(REMEMBER_ME_COOKIE_NAME);

            self::$currentLoggedInUser = null;
            
            return true;
        }
    }