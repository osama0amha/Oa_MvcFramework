<?php

namespace Os\MvcFramework;

use app\Model\User;

abstract class DbModel extends Model
{

    abstract function TableName():string;
    abstract static function Unique():string;

    abstract function Attribute():array;

    public function Save():bool
    {
        $table  = $this->TableName();
        $attribute = $this->Attribute()??[];
        $params = array_map(fn($res) => ":$res",$attribute);

         $resulet = self::prepare("INSERT INTO $table (".implode(',',$attribute).")
          VALUES (".implode(',',$params).")");

         foreach ($attribute as $att){
             $resulet->bindValue(":$att",$this->{$att});
         }

         $resulet->execute();
         return true;
    }


    public static function prepare($sql)
    {
       return Application::$app->dp->pdo->prepare($sql);
    }

   public static function findOn($where)
   {
       $attribute = array_keys($where);
       $str=  implode('AND',array_map(fn($att) => "$att = :$att",$attribute));
       $table = (new \app\Model\User)->TableName();
       $result = self::prepare("SELECT * FROM $table WHERE $str");

      foreach ($where as $key => $value){
          $result->bindValue(":$key",$value);
      }

      $result->execute();
      return $result->fetchObject(User::class);

   }
}