<?php


namespace App\Models;


use app\libraries\Database;

class User extends Database
{
    public function GetUserByEmail($email)
    {
        $this->Query('SELECT * FROM users WHERE email = :email');
        $this->Bind(':email', $email);

        return $this->ReadSingle();
    }
}