<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\View;
use App\Model\User;

class UserController
{
    public function __construct()
    {
        //todo если будет повторяться вынести в родительский класс
        session_start();
    }
    public function addUser()
    {
        $registrationData = $this->validateRegistrationData();
        if (!empty($registrationData['error'])) {
            return new View('register', ['title' => 'Регистрация', 'data' => $registrationData]);
        }

        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => password_hash($registrationData['password'], PASSWORD_DEFAULT),
        ]);

        $user->authorize();
        header('location: /');
    }

    public function register()
    {
        if (!isAuthorized()) {
            return new View('register', ['title' => 'Регистрация']);
        } else {
            header('location: /');
        }
    }

    private function validateRegistrationData()
    {
        $result = ['error' => ""];
        $emptyAllPostValues = true;
        if (!empty($_POST) ) {
            foreach ($_POST as $data) {
                $emptyAllPostValues &= empty($data);
            }
            if (!$emptyAllPostValues) {
                if (empty($_POST['name'])) {
                    $result['error'] .= "Заполните имя. <br>";
                }
                if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $result['error'] .= "Введите корректный E-mail адрес. <br>";
                } elseif (!empty(User::where('email', clean($_POST['email']))->first())) {
                    $result['error'] .= "Пользователь с таким E-mail адресом существует. <br>";
                }
                if (empty($_POST['password'])) {
                    $result['error'] .= "Пароль не может быть пустым. <br>";
                } elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
                    $result['error'] .= "Пароли не совпадают. <br>";
                } else {
                    $result += [
                        'password' => clean($_POST['password']),
                        'passwordConfirm' => clean($_POST['passwordConfirm']),
                    ];
                }
                if (empty($_POST['agreement']) || $_POST['agreement'] !== "on") {
                    $result['error'] .= "Необходимо принять правила сайта. <br>";
                } else {
                    $result += ['agreement' => 'checked'];
                }
            }
        }
        if ($emptyAllPostValues) {
            $result['error'] = "Заполните все поля формы регистрации.";
        }
        $result += ['name' => clean($_POST['name'])];
        $result += ['email' => clean($_POST['email'])];

        return $result;
    }

    public function auth()
    {
        if (!isAuthorized()) {
            $data = [];
            if (isset($_COOKIE['email'])) {
                $data += ['email' => clean($_COOKIE['email'])];
            }
            return new View('auth', ['title' => 'Авторизация', 'data' => $data]);
        } else {
            header('location: /');
        }
    }

    public function authorization()
    {
        $authData = $this->validateAuthData();
        if (!empty($authData['error'])) {
            return new View('auth', ['title' => 'Авторизация', 'data' => $authData]);
        }

        $authData['user']->authorize($authData['remember']);
        header('location: /');
    }

    private function validateAuthData()
    {
        $result = ['error' => "", 'user' => null];
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            if (!filter_var(clean($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $result['error'] = "Введите корректный E-mail адрес.";
            } else {
                $user = User::where('email', clean($_POST['email']))->first();
                if (!empty($user) && password_verify($_POST['password'], $user->password)) {
                    $result['user'] = $user;
                } else {
                    $result['error'] = "Неверная пара E-mail и пароль.";
                }
            }
        } else {
            $result['error'] = "Заполните поля E-mail и пароль.";
        }
        $result += [
            'email' => clean($_POST['email']),
            'remember' => !empty($_POST['remember']),
        ];

        return $result;
    }

    public function logout()
    { //todo определиться где авторизовать и разавторизовывать пользователя? Здесь или в User?
        if (isAuthorized()) {
            session_destroy();
            unset($_SESSION);
        }
        header('location: /');
    }

    public function profile($params = '')
    {
        if (!empty($params) && isAuthorized()) {
            $id = intval($params);
            $user = User::where('id', $id)->first();
            if ($user) {
                return new View(
                    'profile',
                    [
                        'title' => 'Профиль пользователя',
                        'name' => $user->name,
                        'email' => $user->email,
                        'about' => $user->about,
                        'created_at' => $user->created_at,
                    ]);
            }
        }
        //todo сделать вариацию на предмет предложить авторизоваться или зарегистрироваться,
        //если !isAuthorized()
        throw new NotFoundException("Страница не найдена", 404);
    }
}
