<?php

// 웹이 동작하는데 필요한 util 클래스들을 묶어놓은 파일이다.
require 'core/CoreBundle.php';

// 라우팅을 위한 작업
$uri = RequestURI::uriPath();

require Router::load('routes.php')->direct($uri, RequestURI::defineRequestType());