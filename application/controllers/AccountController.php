<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    /**
     * Функция вызывается при переходе на страницу логина
     */
    public function loginAction()
    {

        if (isset($_SESSION['login']) || isset($_COOKIE['login'])) {
            $this->view->redirect('/account/feed');
        }
        if (!empty($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['login'] = true;

            setcookie('login', true, time() + 3600);
            $this->view->location('/account/feed');
        }
        $this->view->render('Вход');
    }

    /**
     * Функция вызывается при переходе на страницу регистрации(при успехе переходит на страницу логина)
     */
    public function registerAction()
    {

        if (!empty($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (!$this->model->registerValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $this->view->location('/');
        }
        $this->view->render('Страница регистрации');
    }

    /**
     * Функция вызывается при успешном логине в аккаунт
     */
    public function feedAction()
    {
        $this->view->render('Добро пожаловать');
    }

    /**
     * Функция вызывается при выходе из аккаунта
     */
    public function logoutAction()
    {
        unset($_SESSION['login']);
        setcookie('login', true, time() - 3600, '/');
        setcookie('name', true, time() - 3600, '/');

        $this->view->redirect('/');
    }
}
