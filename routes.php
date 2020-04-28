<?php

// 메인 홈페이지 : 상단 네비게이션 바로 이동 하는 루트
$router->get('', 'controllers/index.php');
$router->get('news', 'controllers/news.php');
$router->get('information', 'controllers/information.php');
// 자유계시판 관련 루트
$router->get('board', 'controllers/board.php');
$router->get('board-read', 'controllers/board-read.php');
$router->get('board-write', 'controllers/board-write.php');
$router->get('broadcast', 'controllers/broadcast.php');

// 로그인 및 회원가입 루트
//사용자가 처음 접속했을 때  GET으로 반응
$router->get('login', 'controllers/login.php');
$router->get('register', 'controllers/register.php');

// 포스트 메소드로 넘어온 정보를 처리하는 루트
$router->post('registerHandler', 'controllers/postHandler/registerHandler.php');
$router->post('board-writeHandler', 'controllers/postHandler/boardWriteHandler.php');
$router->post('login-startsession', 'controllers/postHandler/sessionHandler/startSession.php');