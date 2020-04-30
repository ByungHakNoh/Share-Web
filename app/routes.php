<?php

// 메인 홈페이지 : 상단 네비게이션 바로 이동 하는 루트
$router->get('', 'PagesController@home');
$router->get('news', 'PagesController@news');
$router->get('information', 'PagesController@information');
// 자유계시판 관련 루트
$router->get('board', 'PagesController@board');
$router->get('board-read', 'PagesController@boardRead');
$router->get('board-write', 'PagesController@boardWrite');
$router->get('broadcast', 'PagesController@broadcast');
// 로그인 및 회원가입 루트
$router->get('login', 'UserController@login');
$router->get('register', 'UserController@register');

// 포스트 메소드로 넘어온 정보를 처리하는 루트
$router->post('registerHandler', 'PostController@register');
$router->post('board-writeHandler', 'PostController@boardWrite');
// $router->post('login-startsession', 'PagesController@home');