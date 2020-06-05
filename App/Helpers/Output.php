<?php


namespace App\Helpers;


class Output
{
    public static function IsInvalid($error , $string)
    {
        if(isset($error[$string]))
        {
            return "is-invalid";
        }
        else
        {
            return "";
        }
    }

    public static function Isset($errors, $string)
    {
        if(isset($errors[$string]))
        {
            return $errors[$string];
        }
        else
        {
            return "";
        }
    }

    public static function Selected($posts, $name, $value)
    {
        if(isset($posts[$name]) && $posts[$name] == $value)
        {
            return "SELECTED";
        }
        else
        {
            return "";
        }
    }

    public static function IsInCheckedArrayOfArray($post, $arrayName, $value)
    {
        if(isset($post[$arrayName]) && in_array($value, $post[$arrayName]))
            return "CHECKED";


        return "";
    }

    public static function IsInCheckedArrayOfObject($objectArray, $value)
    {

        return in_array($value, $objectArray) ? "CHECKED" : "";
    }

}