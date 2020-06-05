<?php
 namespace App\Libraries;

use App\Helpers\Navigation;

/**
 *
 */
class Controller extends Model
{

  protected function view($view, $data = [], $modules = []){

      $navigation = Navigation::GetRoleNavigations();


          $sidebar = Navigation::SortByLocation($navigation, 'sidebar');
          $topbar = Navigation::SortByLocation($navigation, 'topbar');



      extract($data);

      require_once  APPROOT . 'Views/' . $view . '.php';
  }


}
