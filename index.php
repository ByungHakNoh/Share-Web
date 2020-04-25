<?php

require 'core/CoreBundle.php';

$uri = RequestURI::uriPath();

require Router::load('routes.php')->direct($uri);