<?php

namespace Os\MvcFramework;

use Os\MvcFramework\middleware\AuthMiddleware;

class Controller
{

    public array $ArrMiddleware = [];
    public function render($path,$params=[])
    {
        return Application::$app->route->MainView($path,$params);
    }

    public function redirect(string $str)
    {
        header("location:$str");
    }

    public function isGet():bool
    {
        return Application::$app->request->isGET();
    }

    public function isPost():bool
    {
        return Application::$app->request->isPOST();
    }

    public function registerMiddleware(array $arr = []):void
    {
            $this->ArrMiddleware = $arr;

    }

}