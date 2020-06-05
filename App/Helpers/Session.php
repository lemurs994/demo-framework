<?php


namespace App\Helpers {


    use App\Libraries\Model;

    class Session extends  Model
    {
        /**
         * @return int
         */
        public static function GetUserType()
        {
            if(isset($_SESSION['user_id']))
            {
                $model = (new Static);
                $model->model('role');
                return $model->role->GetUserRoleIdByUserId($_SESSION['user_id'])->role_id;

            } else
            {
                return 1;
            }
        }

        public static function SetSession($userData)
        {
            $_SESSION['user_id'] = $userData->id;
            $_SESSION['logged_in'] = true;

        }
    }
}