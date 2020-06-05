<?php

namespace App\Libraries;

use App\Helpers\Regex;

/**
 *
 */
class Router extends Model
{

  private $params = [];

  private  $default;



  public function __construct()
  {
    $this->model('route');


      $this->default = (object) [
        'controller' => 'error',
        'method' => 'index',
        'name' => 'Default Error Page',
          'params' => []
        ];

  }

    public function Route($uri , $request , $user)
    {

        $result = $this->default;
        $routes = $this->LoadRoutes($user, $request);

        foreach ($routes as $route)
        {
            if($this->Match($uri, $route->link))
            {
                $result = $route;
                $result->params = $this->params;
            }
        }

        return $result;
   }

    /**
     * @param int $user
     * @param $request
     * @return object[]
    */
    private function LoadRoutes(int $user, $request){
        return $this->route->GetRoutesByRequestAndUserType($user, $request);
    }


    /**
     * @param $url
     * @return string|string[]|null
     */


    /**
     * @param $uri  String , user requested link
     * @param $url String , link from db
     * @return bool
     */
    private function Match($uri, $url){

        $url = Regex::PrepareUrl($url);

        if(preg_match($url, $uri, $matches))
        {
            foreach ($matches as $key => $match)
            {
                    if(is_string($key))
                    {
                        $this->params[$key] = $match;
                    }
            }

            return true;
        }

        return false;
    }

}
