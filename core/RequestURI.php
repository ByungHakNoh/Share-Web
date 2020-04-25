<?php

class RequestURI
{

    public static function uriPath()
    {
        // get 사용 시 ?뒤 url 지우기 + / 지우기
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
    }
}