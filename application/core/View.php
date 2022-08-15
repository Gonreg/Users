<?php

namespace application\core;

class View
{
    /**
     * @var string
     */
    public string $path;

    /**
     * @var array
     */
    public array $route;

    /**
     * @var string
     */
    public string $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    /**
     * Метод отрисовывает нужный макет
     *
     * @param string $title
     * @param array $vars
     */
    public function render(string $title, array $vars = [])
    {
        extract($vars);
        $path = 'application/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден: ' . $this->path;
        }
    }

    /**
     * Метод для редиректа
     *
     * @param $url
     */
    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }

    /**
     * Метод отрисовывает страницу с ошибкой
     *
     * @param $type
     */
    public static function errorCode($type)
    {
        http_response_code($type);
        $path = 'application/views/errors/' . $type . '.php';
        if (file_exists($path)) {
            require $path;

            exit;
        }
    }

    /**
     * Метод используется для появления уведомления об ошибке в форме
     *
     * @param $status
     * @param $message
     */
    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    /**
     * Метод для редиректа, только с использованием json
     *
     * @param $url
     */
    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

}
