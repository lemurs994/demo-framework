<?php

namespace app\libraries;


class Request
{

    /**
     * @return string
     */
    public static function Uri() : string{

        $url =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) != null ?
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) :
                "error";

        return $url == '/' ? $url : rtrim($url, '/');

    }

    /**
     * @return string
     */
    public static function Method() :string{
    return $_SERVER['REQUEST_METHOD'];
  }
}
