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
    <title><?=$title ?? 'Блог'?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="/css/my.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/"><img src="/layout/img/blog.png" width="50" height="50" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">О Блоге</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contacts">Контакты</a>
          </li>
        </ul>
          <?php if (UserController::isModerator()) {?>
            <ul class="navbar-nav mr-auto">
                <?php if (UserController::isAdmin()) {?>
            <li class="nav-item active">
                <a class="nav-link" href="/users">Пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/subscribers">Подписки</a>
            </li>
                <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="/notes">Статьи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contacts">Комментарии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/statics">Страницы</a>
            </li>
                <?php if (UserController::isAdmin()) {?>
                    <li class="nav-item">
                <a class="nav-link" href="/contacts">Настройки</a>
            </li>
                <?php } ?>
        </ul>
          <?php } ?>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--                    todo подумать над передачей имени пользователя через $data-->
                    <?=isAuthorized() ? $_SESSION['user']['name'] : 'Меню пользователя'?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <?php
                    if (!isAuthorized()) { ?>
                        <a class="dropdown-item" href="/auth">Войти</a>
                        <a class="dropdown-item" href="/register">Зарегистрироваться</a>
                    <?php }
                    if (isAuthorized()) { ?>
                        <a class="dropdown-item" href="/profile/<?=$_SESSION['user']['id'] ?? ''?>" >Профиль</a>
                        <a class="dropdown-item" href="/logout">Выйти</a>
                    <?php } ?>
                </div>
            </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="container">
        <div class="main-content">

