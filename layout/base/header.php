<?php

use App\Controller\UserController;

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?? 'Блог' ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="/css/my.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/"><img src="/layout/img/blog.png" width="50" height="50"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">


            <ul class="navbar-nav me-auto">
                <li class="nav-item <?= isActiveMenu('/') ?>">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item <?= isActiveMenu('/about') ?>">
                    <a class="nav-link" href="/about">О Блоге</a>
                </li>
                <li class="nav-item <?= isActiveMenu('/contacts') ?>">
                    <a class="nav-link" href="/contacts">Контакты</a>
                </li>
            </ul>



            <ul class="navbar-nav">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <!--                    todo подумать над передачей имени пользователя через $data-->
                        <?= isAuthorized() ? $_SESSION['user']['name'] : 'Меню пользователя' ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown02">
                        <?php if (!isAuthorized()) { ?>
                            <a class="dropdown-item" href="/auth">Войти</a>
                            <a class="dropdown-item" href="/register">Зарегистрироваться</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="/profile/<?= $_SESSION['user']['id'] ?? '' ?>">Профиль</a>
                            <a class="dropdown-item" href="/logout">Выйти</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
    </div>



</nav>
<div class="nav-scroller bg-body shadow-sm">
    <nav class="nav nav-underline justify-content-end" aria-label="Secondary navigation">

        <?php  if (UserController::isModerator()) {
                            if (UserController::isAdmin()) { ?>
                                <a class="nav-link active" href="/users">Пользователи</a>
                                <a class="nav-link" href="/subscribers">Подписки</a>
                            <?php } ?>
                            <a class="nav-link" href="/notes">Статьи</a>
                            <a class="nav-link" href="/comments">Комментарии</a>
                            <a class="nav-link" href="/statics">Страницы</a>
                        <?php }
                            if (UserController::isAdmin()) { ?>
        <a class="nav-link" href="/settings">Настройки</a>
                            <?php } ?>

    </nav>
</div>


<main role="main" class="container">
    <div class="main-content">

