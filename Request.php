<?php

namespace Os\MvcFramework;

class Request
{
    public function getMethod():string
    {
         return strtolower($_SERVER['REQUEST_METHOD']);

    }
    public function getPath():string
    {
        $st1path = $_SERVER['REQUEST_URI'];
        $pathFound = strpos($st1path,'?')??false;
        if(!$pathFound)
        {
            return $st1path;
        }
        return substr($st1path,0,$pathFound );
    }
    public function isGET():bool
    {
        if($this->getMethod() == 'get')return true;
        return false;
    }
    public function isPOST():bool
    {
        if($this->getMethod() == 'post')return true;
        return false;
    }

    public  function getBody():array
    {
      $arr = [];
      if($this->isGET()){
          foreach ($_POST as $key => $value){
              $arr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
          }
      }
      elseif($this->isPOST()){
          foreach ($_POST as $key => $value){
              $arr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
          }
      }
      return $arr;
    }
}

