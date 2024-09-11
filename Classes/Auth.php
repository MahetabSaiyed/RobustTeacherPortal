<?php

    /**
     * Class: Auth
     * Desc: Authentication Functions are defined here
     */
    class Auth
    {
        public static $isActive = false;
        public static function isLogin($con)
        {
            if( !isset($_SESSION) )
            {   session_start();    }

            if( isset($_COOKIE['user_id']) and $_COOKIE['token'] and isset($_COOKIE['serial']) )
            {
                $user_id = $_COOKIE['user_id'];
                $token = $_COOKIE['token'];
                $serial = $_COOKIE['serial'];

                $sessQ = " SELECT * FROM session_master WHERE session_userid = :user_id AND session_token = :token AND session_serial = :serial  ";
                $stmtSess = $con->prepare($sessQ);
                $stmtSess->execute([ ":user_id"=>$user_id , ":token" => $token, ":serial"=>$serial ]);
                $rowSess = $stmtSess->fetch(PDO::FETCH_ASSOC);

                if($rowSess['session_userid'] > 0)
                {
                    if( $rowSess['session_userid'] == $_COOKIE['user_id']
                    and $rowSess['session_token'] == $_COOKIE['token']
                    and $rowSess['session_serial'] == $_COOKIE['serial'] )
                    {
                        if( !( isset($_COOKIE[session_name()])
                        and $rowSess['session_userid'] == $_SESSION['user_id']
                        and $rowSess['session_token'] == $_SESSION['token']
                        and $rowSess['session_serial'] == $_SESSION['serial'] ) )
                        {
                            Auth::createSession($_COOKIE['user_id'], $_COOKIE['user_name'], $_COOKIE['token'], $_COOKIE['serial']);
                        }
                        return true;
                    }
                }

            }
        }

        public static function checkAuth($con, $username, $password)
        {
            $selUser = " SELECT * FROM user_master WHERE user_name = :username AND user_pwd = :password ";
            $stmtU = $con->prepare($selUser);
            $stmtU->execute([":username"=>$username, ":password" => $password ]);
            $rowU = $stmtU->fetch(PDO::FETCH_ASSOC);

            if($rowU['user_id'] > 0)
            {
                Auth::createRecord($con, $rowU['user_id'], $rowU['user_name']);
                return true;
            }
            return false;
        }

        public static function createRecord($con, $user_id, $user_name)
        {
            // Delete Previous Session
            $con->prepare("DELETE FROM session_master WHERE session_userid = :user_id")->execute([ ":user_id" => $user_id ]);
            
            // Create Token and Serial
            $token = Functions::createString(30);
            $serial = Functions::createString(30);

            // Create Cookies and Sessions
            Auth::createCookie($user_id, $user_name, $token, $serial);
            Auth::createSession($user_id, $user_name, $token, $serial);

            // Insert New Session
            $InsSess = $con->prepare(" INSERT INTO session_master ( session_userid, session_token, session_serial, session_date ) VALUES ( :user_id, :token, :serial, NOW() ) ");
            $InsSess->execute([ ":user_id" => $user_id, ":token" => $token, ":serial" => $serial ]);
                

        }

        public static function createCookie($user_id, $user_name, $token, $serial)
        {
            $expCookie = time() + 86400 * 30;
            setcookie('user_id', $user_id, $expCookie, "/");
            setcookie('user_name', $user_name, $expCookie, "/");
            setcookie('token', $token, $expCookie, "/");
            setcookie('serial', $serial, $expCookie, "/");
        }

        public static function deleteCookie()
        {
            $expCookie = time() - 1;
            setcookie(session_name(), "", $expCookie, "/");
            setcookie('user_id', "", $expCookie, "/");
            setcookie('user_name', "", $expCookie, "/");
            setcookie('token', "", $expCookie, "/");
            setcookie('serial', "", $expCookie, "/");
        }

        public static function createSession($user_id, $user_name, $token, $serial)
        {
            if( !isset($_SESSION) )
            {   session_start();    }

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['token'] = $token;
            $_SESSION['serial'] = $serial;
        }

        public static function deleteSession()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['token']);
            unset($_SESSION['serial']);
            session_unset();
            session_destroy();
        }

        public static function logout()
        {
            Auth::deleteCookie();
            Auth::deleteSession();
        }

    }
    