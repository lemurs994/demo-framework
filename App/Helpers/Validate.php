<?php


namespace App\Helpers;


class Validate
{


    public static function GeneralEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return [
                'result' => false,
                'error' => 'email is not valid'
            ];
        }


        return [
            'result' => true
        ];
    }


    public static function RegisterEmail($email)
    {
        if(Self::GeneralEmail($email)['result'])
        {
            return true;
        }

        return false;
    }

    public static function Password($password)
    {

        if(strlen($password) > MAX_PASSWORD_LENGTH)
        {
            return [
                'result' => false,
                'error' => 'password is to long'
            ];
        }

        if(strlen($password) < MIN_PASSWORD_LENGTH)
        {
            return [
              'result' => false,
                'error' => 'password is to short'
            ];
        }

        return [
            'result' => true
        ];
    }

    public static function Link($link)
    {

        if(filter_var(URLROOT . $link, FILTER_VALIDATE_URL))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}