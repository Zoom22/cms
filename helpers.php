<?php

function array_get($array, $key, $default = null) 
{
    $keys = explode('.', $key);
    $result = $array;
    foreach ($keys as $key) {
        if (!isset($result[$key])) {
            return $default;
        }
        $result = $result[$key];
    }

     return $result;
}

function includeView($templateName, $data) 
{

    extract($data);
    include $templateName;
}

function loginUser(\App\Model\User $user) 
{
    $_SESSION['user'] = $user;
    $_SESSION['login'] = true;
    setcookie('userLogin', $user->email, time() + 60 * 60 * 24 * 20, '/');
}

function clean($value = '')
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

function isAuthorized()
{
    return !empty($_SESSION['user']['authorized']);
}