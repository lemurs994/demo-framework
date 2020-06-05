<?php


namespace App\Helpers;


class Sanitize
{
    public static function email(string $email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public static function string(string $password)
    {
        return filter_var($password, FILTER_SANITIZE_STRING);
    }

    public static function Post($post)
    {
        foreach ($post as $name => $value)
        {
            if(is_string($value))
                $post[$name] = Self::string($value);
        }

        return $post;
    }
}