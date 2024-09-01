<?php

namespace Os\MvcFramework\Forms;

class Form
{

    public static function begin($action, $method):Form
    {
        echo sprintf("<form action = '%s' method ='%s' >",$action,$method);
        return new Form();
    }

    public function field($Model,$firstName):field
    {
        return new field($Model,$firstName);
    }

    public static function end():void
    {
         echo "</form>";
    }
}