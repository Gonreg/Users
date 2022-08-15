<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{
    /**
     * @var string
     */
    public string $error;

    /**
     * @var array
     */
    private array $userData;

    /**
     * Метод для валидации данных при логине
     *
     * @param $post
     *
     * @return bool
     */
    public function loginValidate($post): bool
    {

        $pass = $this->hashData($post['password']);
        $login = $post['login'];
        if ($this->db->findRecord($login, 'login')) {
            $this->error = 'login,Такого пользователя не существует';
            return false;
        }
        $passToCheck = $this->db->getSingleRecord($login, 'login')['password'];
        if ($pass !== $passToCheck) {
            $this->error = 'password,Пароль не верный';
            return false;
        }

        setcookie('name', $this->db->getSingleRecord($login, 'login')['name'], time() + 3600);
        return true;
    }

    /**
     * Метод для валидации данных при регистрации
     *
     * @param $post
     *
     * @return bool
     */
    public function registerValidate($post): bool
    {
        $login = $post['login'];

        if (iconv_strlen($post['login']) < 6) {
            $this->error = 'login,Логин не должен быть меньше 6 символов';

            return false;
        }
        if (!$this->db->findRecord($post['login'], 'login')) {
            $this->error = 'login,Такой логин уже существует';
            return false;
        }
        $this->userData['login'] = $post['login'];

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'email,Неккоректный адрес электронной почты';
            return false;
        }
        if (!$this->db->findRecord($post['email'], 'email')) {
            $this->error = 'email,Такая почта уже существует';
            return false;
        }
        $this->userData['email'] = $post['email'];

        if ($post['password'] != $post['password_repeat']) {
            $this->error = 'password_repeat,Пароли должны совпадать';
            return false;
        }
        if (iconv_strlen($post['password']) < 6) {
            $this->error = 'password,Пароль должен быть не меньше 6 символов';
            return false;
        }
        if (!preg_match('~\d~', $post['password'])) {
            $this->error = 'password,Пароль должен иметь хотя бы одну цифру';
            return false;
        }
        if (!preg_match('~[a-zа-яё]~', $post['password'])) {
            $this->error = 'password,Пароль должен иметь хотя бы одну букву';
            return false;
        }
        if (!preg_match('~[A-ZА-ЯЁ]~', $post['password'])) {
            $this->error = 'password,Пароль должен иметь хотя бы одну заглавную букву';
            return false;
        }
        $this->userData['password'] = $this->hashData($post['password']);

        if (iconv_strlen($post['name']) < 2) {
            $this->error = 'name,Имя должно быть не менее 2 символов';
            return false;
        }
        if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{1,30}))$/u", $post['name'])) {
            $this->error = 'name,Имя должно состоять только из букв';
            return false;
        }
        $this->userData['name'] = $post['name'];
        $this->userData['family'] = $post['family'];
        $this->userData['id'] = time();

        $this->addUser($this->userData);

        setcookie('name', $this->db->getSingleRecord($login, 'login')['name'], time() + 3600);

        return true;
    }

    /**
     * Метод добавления нового пользователя при регистрации
     *
     * @param $data
     *
     * @return bool
     */
    public function addUser($data): bool
    {
        $this->db->insert($data);
        $this->error = 'Успешная регистрация';
        return false;
    }

    /**
     * Метод хеширования данных
     *
     * @param $data
     *
     * @return string
     */
    private function hashData($data): string
    {
        $salt = 'MyDirtySalt';
        return sha1($data . $salt);
    }
}