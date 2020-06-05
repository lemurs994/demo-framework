<?php

namespace App\Libraries;

use App\Helpers\Session;

/**
 *
 */

class Core
{

  function __construct()
  {


      $result =  (new Router())->Route( Request::Uri(), Request::Method(), Session::GetUserType());

        $result->controller = ucfirst($result->controller);
        $result->method = ucfirst($result->method);

        $result->controller = 'App\Controllers\\' . $result->controller;

        // TODO: add method exists before calling method

       call_user_func_array([ new $result->controller, $result->method], $result->params);
  }
}
