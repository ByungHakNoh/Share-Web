<?php

class RequestURI
{

    public static function uriPath()
    {
        // Memo : get 사용 시 '?'뒤 url 지우기(PHP_URL_PATH) + '/' 지우기
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
    }

    // GET, POST type을 return 하는 메소드
    public static function defineRequestType()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
