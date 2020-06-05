<?php


namespace App\Models;


use app\libraries\Database;

class Role extends Database
{
    public function GetUserRoleIdByUserId($user_id)
    {
        $this->Query('
            SELECT 
                user_roles.role_id
            FROM
                user_roles
            WHERE 
                user_roles.user_id = :user_id 
        ');

        $this->Bind(':user_id', $user_id);
        return $this->ReadSingle();
    }
}

