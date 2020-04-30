<?php

namespace app\controllers;

use core\mvc\Controller;

class UserController extends Controller
{

    public function register()
    {
        $view = $this->createView('register');
        return $view->loadView();
    }

    public function login()
    {
        $view = $this->createView('login');
        return $view->loadView();
    }
}