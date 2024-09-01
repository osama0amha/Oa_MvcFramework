<?php

namespace Os\MvcFramework\Exceptions;

class AuthException extends \Exception
{
    protected $code = 403;
    protected $message = "no acses profil";

}