<?php
// 에러 로그 출력하는 코드
error_reporting(E_ALL);
ini_set('display_errors', 1);

use core\router\{Router, RequestURI};

// 웹이 동작하는데 필요한 util 클래스들을 묶어놓은 파일이다.
require 'core/CoreBundle.php';
require 'app/controllers/PagesController.php';
require 'app/controllers/UserController.php';
require 'app/controllers/BoardController.php';

session_start();
// 라우팅을 위한 작업
$uri = RequestURI::uriPath();

Router::load('app/routes.php')->direct($uri, RequestURI::defineRequestType());
