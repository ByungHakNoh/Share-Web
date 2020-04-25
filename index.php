<?php

require 'core/CoreBundle.php';

$uri = RequestURI::uriPath();
// $uri = trim($_SERVER['REQUEST_URI'], '/');
// var_dump($app);

require Router::load('routes.php')->direct($uri);