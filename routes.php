<?php

$router->get('', 'controllers/index.php');
$router->get('news', 'controllers/news.php');
$router->get('information', 'controllers/information.php');
$router->get('board', 'controllers/board.php');
// 연습용으로 get으로 바꾸기
$router->post('login', 'controllers/login.php');
$router->get('register', 'controllers/register.php');
$router->get('practice', 'controllers/1_practice.php');

var_dump($_SERVER['REQUEST_METHOD']);