<?php

namespace application\core;

use application\core\View;


abstract class Controller
{
    /**
     * @var array
     */
    public array $route;

    /**
     * @var \application\core\View
     */
    public View $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * Метод подгружает необходимую модель
     *
     * @param $name
     *
     * @return mixed
     */
    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }
}