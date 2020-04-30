<?php

namespace core\mvc;

use core\mvc\View;

class Controller
{

    protected $view;
    protected $model;

    protected function createView($view, $data = [])
    {
        $this->view = new View($view, $data);
        return $this->view;
    }

    protected function createModel($model)
    {
        require "app/models/{$model}.php";
        $model = "app\models\\{$model}";
        return new $model;
    }

    public function createPostModel($model)
    {
        require "app/models/post/{$model}.php";
        $model = "app\models\post\\{$model}";
        return new $model;
    }
}