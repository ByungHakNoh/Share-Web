<?php

class Router
{
    protected $routes = [];

    public static function load($file)
    {
        // 자기 자신 객체를 생성할 때 사용
        $router = new static;

        require $file;

        return $router;
    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function direct($uri)
    {
        if (array_key_exists($uri, $this->routes)) {

            return $this->routes[$uri];
        }
        // 동작하지 않음 -> 페이지 자체가 실행되지 않기 때문 -> 페이지 디버깅 방법 찾기
        throw new Exception('URI 정확하지 않음');
    }
}
