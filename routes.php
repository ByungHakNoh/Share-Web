<?php

// 메인 홈페이지 : 상단 네비게이션 바로 이동 하는 루트
$router->get('', 'controllers/index.php');
$router->get('news', 'controllers/news.php');
$router->get('information', 'controllers/information.php');
$router->get('board', 'controllers/board.php');
$router->get('broadcast', 'controllers/broadcast.php');

// 로그인 및 회원가입 루트
//사용자가 처음 접속했을 때  GET으로 반응
$router->get('login', 'controllers/login.php');
$router->get('register', 'controllers/register.php');
// 회원가입 버튼을 누를 시 POST로 반응
$router->post('login', 'controllers/login.php');
$router->post('register', 'controllers/register.php');

$router->get('board-write', 'controllers/write.php');
$router->post('board-write', 'controllers/write.php');

//연습용 루트
$router->get('practice', 'controllers/1_practice.php');
$router->post('practice2', 'controllers/2_practice.php');