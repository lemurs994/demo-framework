<?php


namespace App\Helpers;


use App\Libraries\Model;

class Navigation extends Model
{



    public static function GetRoleNavigations()
    {

        $role_id = Session::GetUserType();

        $model = (new Static);
        $model->model('navigation');
        return $model->navigation->GetNavigationsByRoleId($role_id);
    }

    public static function GetUserNavigations()
    {
        // Get user id
        // get all routes where user id
        // return routes

        // This is if or when use needs custom navigation options
    }

    public static function SortByLocation($navigations, $location)
    {
            $result = [];

        foreach ($navigations as $navigation)
        {
            if ($navigation->location == $location)
                $result[] = $navigation;
        }

            return $result;
    }


}