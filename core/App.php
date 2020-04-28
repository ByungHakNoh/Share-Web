<?php

// 웹 동작에 있어서 필요한 정보를 registry 배열에 저장하는 static 클래스이다. 
class App
{

    protected static $registry = [];

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {

            throw new Exception("From App : {$key} 관련 값이 존재하지 않음");
        }

        return static::$registry[$key];
    }
}