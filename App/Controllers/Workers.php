<?php


namespace App\Controller;

use App\Libraries\Controller;

/**
 *
 */
class Workers extends Controller
{
  public function ViewAll()
  {


    $this->view('dashboard/index', [], ['test/test']);
  }
}
