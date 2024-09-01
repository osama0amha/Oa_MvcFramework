<?php

namespace Os\MvcFramework;

use Os\MvcFramework\Exceptions\AuthException;
use Os\MvcFramework\middleware\AuthMiddleware;
use Os\MvcFramework\middleware\BuildMiddleware;

class Route
{

    protected array $path = [];
    protected Request $request;
    public Response  $response;
    public  ?Controller $controller;



    public function __construct(Request $request ,Response $response)
    {
        $this->request = $request;
        $this->response = $response;

    }
    public function title(string $str):void
    {
       echo "<title>$str</title>";
    }

    public function get(string $url, $content)
    {
          $this->path['get'][$url] = $content;
    }
    public function post(string $url, $content)
    {
        $this->path['post'][$url] = $content;
    }
    public function resolve()
    {
        $getMethod = $this->request->getMethod();
        $getPath = $this->request->getPath();
        $content = $this->path[$getMethod][$getPath]??false;

      if(!$content){
          $this->response->status(401);
          return  $this->MainView("__404");
      }

      if(is_string($content))
      {
          return $this->MainView($content);
      }
      if(is_array($content)){

          $content[0] = new $content[0]();
          $this->controller = $content[0];

      }
        $test = new AuthMiddleware();

      foreach ($this->controller->ArrMiddleware as $middleware){
          if($middleware == $content[1]){
              $test->execute();
          }


      }
      return call_user_func($content,$this->request);

    }

    public function MainView($view, $params=[])
    {

        $layoutView = $this->LayoutView();
        $viewContent = $this->ViewContent($view,$params);
        return str_replace('{{content}}',$viewContent,$layoutView);

    }
    public function LayoutView()
    {
         ob_start();
         include_once Application::$DirRoute ."/View/Layout/main.php";
         return ob_get_clean();
    }
    public function ViewContent($view,array $params)
    {
        foreach ( $params as $key => $value){
              $$key = $value;
        };
        ob_start();
        include_once Application::$DirRoute ."/View/$view.php";
        return ob_get_clean();

    }


}