<?php

// // 메인 홈페이지 : 상단 네비게이션 바로 이동 하는 루트
// $router->get('', 'controllers/index.php');
// $router->get('news', 'controllers/news.php');
// $router->get('information', 'controllers/information.php');
// // 자유계시판 관련 루트
// $router->get('board', 'controllers/board.php');
// $router->get('board-read', 'controllers/board-read.php');
// $router->get('board-write', 'controllers/board-write.php');
// $router->get('broadcast', 'controllers/broadcast.php');

// // 로그인 및 회원가입 루트
// //사용자가 처음 접속했을 때  GET으로 반응
// $router->get('login', 'controllers/login.php');
// $router->get('register', 'controllers/register.php');

// // 포스트 메소드로 넘어온 정보를 처리하는 루트
// $router->post('registerHandler', 'controllers/postHandler/registerHandler.php');
// $router->post('board-writeHandler', 'controllers/postHandler/boardWriteHandler.php');
// $router->post('login-startsession', 'controllers/postHandler/sessionHandler/startSession.php');








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
$router->post('registerHandler', 'PagesController@home');
$router->post('board-writeHandler', 'PagesController@home');
$router->post('login-startsession', 'PagesController@home');