<?php

namespace Os\MvcFramework;

class Response
{
     public function status($code):void
     {
         http_response_code($code);
     }
}