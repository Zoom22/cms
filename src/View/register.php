<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">

    <title><?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/floating-labels.css" rel="stylesheet">
</head>

<body>

<form class="form-signin" method="post" action="/register">
    <div class="text-center mb-4">
        <a href="/"><img src="/layout/img/blog.png" width="100" height="100" ></a>
        <h1 class="h3 mb-3 font-weight-normal">Регистрация на сайте</h1>
        <?php if (!empty($data['error'])) { ?>
            <div class="alert alert-danger" role="alert"><?=$data['error']?></div>
        <?php } else { ?>
            <p>Заполните поля</p>
        <?php } ?>
    </div>
    <!--        todo добавить required к полям формы-->
    <div class="form-label-group">
        <input type="name" id="inputName" class="form-control" placeholder="Имя" name="name" value="<?=$data['name'] ?? ''?>" autofocus>
        <label for="inputEmail">Имя</label>
    </div>

    <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" value="<?=$data['email'] ?? ''?>" autofocus>
        <label for="inputEmail">Email</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" name="password" value="<?=$data['password'] ?? ''?>" >
        <label for="inputPassword">Пароль</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPasswordConfirm" class="form-control" placeholder="Повторите пароль" name="passwordConfirm" value="<?=$data['passwordConfirm'] ?? ''?>">
        <label for="inputPassword">Повторите пароль</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="agreement" <?=$data['agreement'] ?? ''?>> Согласен с <a class="stretched-link font-weight-bold" href="/static/rules">правилами</a> сайта.
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; Все права защищены, <?=date('Y')?></p>
</form>
</body>
</html>
