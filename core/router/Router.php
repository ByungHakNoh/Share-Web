<?php

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    // requestType 을 선별하고 uri의 end point 를 반환
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {

            return $this->routes[$requestType][$uri];
        }
        // 동작하지 않음 -> 페이지 자체가 실행되지 않기 때문 -> 페이지 디버깅 방법 찾기
        throw new Exception('URI 정확하지 않음');
    }

    // $router 객체를 생성, $file = router.php 파일을 로드하여 routes 데이터 입력 후 반환하는 메소드
    public static function load($file)
    {
        // 자기 자신 객체를 생성할 때 사용
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}