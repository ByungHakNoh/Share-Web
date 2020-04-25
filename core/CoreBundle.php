<?php

// 어디서든지 config 나 database에 접근하려면 $app 배열(key-value)을 사용하면 된다.
$app = [];

$app['config'] = require 'config.php';

require 'core/router/Router.php';
require 'core/router/RequestURI.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';

$app['database'] = new QueryBuilder(

    Connection::connect_db($app['config']['database'])
);