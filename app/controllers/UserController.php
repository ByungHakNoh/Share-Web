<?php

class UserController
{

    public function register()
    {

        return loadView('register');
    }

    public function login()
    {

        return loadView('login');
    }
}