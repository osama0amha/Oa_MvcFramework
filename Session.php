<?php

namespace Os\MvcFramework;

class Session
{
    private const MESSAGE_SESSION = 'Msn';
    public function __construct()
    {
        session_start();

        $strSessions = $_SESSION[self::MESSAGE_SESSION]??[];

        foreach ($strSessions as $key => $value){
            $_SESSION[self::MESSAGE_SESSION][$key]['remove'] = true;

        }
        
    }

    public function SetSession($key,$message)
    {
      $_SESSION[self::MESSAGE_SESSION][$key] = [
          'value'=> $message,
          'remove'=> false,
      ];
    }

    public function getSession($key)
    {
        return $_SESSION[self::MESSAGE_SESSION][$key]['value'] ??false;
    }
    public function set($userUn):void
    {
        $_SESSION['user'] = $userUn;
    }

    public function get($key)
    {
        return $_SESSION[$key]??false;
    }

    public function __destruct()
    {
        $strSessions = $_SESSION[self::MESSAGE_SESSION]??[];

        foreach ($strSessions as $key => $value){

            if($value['remove'] == true){
               unset($_SESSION[self::MESSAGE_SESSION][$key]);
           };
        }
    }

}