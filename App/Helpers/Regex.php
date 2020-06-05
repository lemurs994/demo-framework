<?php


namespace App\Helpers;


class Regex
{
    public static function PrepareUrl($url)
    {
        $url = preg_replace('/\//', '\\/', $url);
        $url = preg_replace('/\{([a-zA-Z0-9\-_]+)\}/', '(?P<\1>[a-zA-Z0-9\-_]+)', $url);
        $url = '/^' . $url . '$/i';

        return $url;
    }
}