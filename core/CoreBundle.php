<?php

use core\App;
use core\database\{NameController, QueryBuilder, Connection};

require 'core/mvc/View.php';
require 'core/mvc/Controller.php';
require 'core/mvc/Model.php';
require 'core/router/Router.php';
require 'core/router/RequestURI.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';
require 'core/App.php';

// config와 QueryBuilder 객체를 저장하는 App객체를 어느 파일에서도 사용할 수 있게 저장
App::bind('config', require 'config.php');
App::bind('database',  new QueryBuilder(

    Connection::connectDB(App::get('config')['database'])
));