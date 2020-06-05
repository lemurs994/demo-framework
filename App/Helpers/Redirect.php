<?php


namespace App\Helpers;


class Redirect
{
    public static function  To($string)
    {
        header('Location: ' . URLROOT . $string);
    }
}