<?php
    class UserSessions extends Model {
        public function __construct () {
            $table = 'user_sessions';
            parent::__construct ($table);
        }

        public static function getFromCookie() {
            if (COOKIE::exists(REMEMBER_ME_COOKIE_NAME)) {
                $userSession = new self();
                $userSession = $userSession->findFirst([
                    'conditions' => "userAgent = ? AND userSession = ?",
                    'bind' => [Session::userAgent(), COOKIE::get(REMEMBER_ME_COOKIE_NAME)]
                ]);
            }
            if (!$userSession)
                return false;
            return $userSession;
        }
    }