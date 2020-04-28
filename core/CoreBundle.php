<?php

require 'core/router/Router.php';
require 'core/router/RequestURI.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';
require 'core/App.php';

// config와 QueryBuilder 객체를 저장하는 App객체를 어느 파일에서도 사용할 수 있게 저장
App::bind('config', require 'config.php');
APP::bind('database',  new QueryBuilder(

    Connection::connect_db(App::get('config')['database'])
));

function loadView($view, $data = [])
{
    extract($data);
    return require "app/views/view_{$view}.php";
}