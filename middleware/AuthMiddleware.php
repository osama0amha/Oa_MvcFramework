<?php

namespace Os\MvcFramework\middleware;

use Os\MvcFramework\Application;
use Os\MvcFramework\Exceptions\AuthException;


class AuthMiddleware extends BuildMiddleware
{

    /**
     * @throws AuthException
     */
    public function execute()
    {
        if(!Application::$app->IsFound())
        {
          if(empty(Application::$app->route->controller->ArrMiddlewaree))
          {
             throw new AuthException();
          }
        }

    }
}