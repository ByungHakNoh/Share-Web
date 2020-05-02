<?php

use core\router\{Router, RequestURI};

// 웹이 동작하는데 필요한 util 클래스들을 묶어놓은 파일이다.
require 'core/CoreBundle.php';
require 'app/controllers/MainController.php';
require 'app/controllers/UserController.php';


// 라우팅을 위한 작업
$uri = RequestURI::uriPath();

Router::load('app/routes.php')->direct($uri, RequestURI::defineRequestType());