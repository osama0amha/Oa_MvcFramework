<?php

namespace Os\MvcFramework\Forms;

use Os\MvcFramework\Model;

class field
{
    public $model;
    public string $firstName;
    private string $type = 'text';
   public function __construct($Model,$firstName)
   {
       $this->model = $Model;
       $this->firstName = $firstName;
   }

   public function __toString():string
   {
       return  sprintf('<div class="form-group">
            <label for="exampleInputEmail1">%s</label>
            <input type="%s" class="form-control %s" name="%s" value="%s"
            id="exampleInputEmail1"  placeholder="Enter Name">
            <div class="invalid-feedback">
                 %s
            </div>
        </div>',$this->firstName,
           $this->type,
           $this->model->hasError($this->firstName)?'is-invalid':'',
           $this->firstName,
           $this->model->{$this->firstName},
           $this->model->hasError($this->firstName)?$this->model->firstError($this->firstName):'');
   }
   public function password()
   {
       $this->type = 'password';
       return $this;

   }

}