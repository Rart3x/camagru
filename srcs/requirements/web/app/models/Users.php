<?php
    class Users extends Model {
        private $_isLoggedIn, $_sessionName, $_cookieName;
        
        public static $currentLoggedInUser = null;

        public function __construct($user='') {
            $table = 'Users';
            parent::__construct($table);
            $this->_sessionName = CURRENT_USER_SESSION_NAME;
            $this->_cookieName = REMEMBER_ME_COOKIE_NAME;

            if ($user != '') {
                if (is_int($user))
                    $u = $this->_db->findFirst('Users',['conditions'=>'userId = ?', 'bind'=>[$user]]);
                else
                    $u = $this->_db->findFirst('Users',['conditions'=>'userName = ?','bind'=>[$user]]);
           }
           if ($u) {
                foreach ($u as $key => $val) {
                    $this->$key = $val;
                }
           }
        }

        public function findByUsername($username) {
            return $this->findFirst(['conditions'=>"userName = ?", 'bind'=>[$username]]);
        }

        public function login($rememberMe = false) {
            Session::set($this->_sessionName, $this->id);
            
            if ($rememberMe) {
                $hash = md5(uniqid() + rand(0, 100));
                $user_agent = Session::uagent_no_version();
                
                Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
                
                $fields = ['session'=>$hash, 'userAgent'=>$user_agent, 'userId'=>$this->id];
                $this->_db->query("DELETE FROM UserSessions WHERE userId = ? AND userAgent = ?", [$this->id, $user_agent]);
                $this->_db->insert('UserSessions', $fields);
            } 
        }
    }