<?php

namespace App\Libraries;

/**
 *
 */
class Model
{
  public function model($model){
    $name = $model;
    $model = '\App\Models\\' . ucfirst($model);
    $this->$name = new $model;
  }
}
