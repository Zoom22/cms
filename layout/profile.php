<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-4">
        <form id="photo" enctype="multipart/form-data" method="post" action="/profile/edit">
            <label for="avatar" data-bs-toggle="tooltip" data-bs-placement="right" title="Нажмите на картинку для смены аватара">
                <input type="text" name="id" value="<?=$id?>" hidden>
                <img src="/layout/img/photo/<?=$photo?>" width="250" class="rounded" alt="Avatar">
            </label>
            <input type="file" name="avatar" id="avatar" hidden accept="image/jpeg, image/png">
        </form>
    </div>
    <div class="col-8 m-auto">
        <form id="form">
            <input type="text" name="id" value="<?=$id?>" hidden>
            <div class="row">
                <div class="col-12 mb-2 text-info">Краткая информация:</div>
            </div>
            <div class="row" >
                <div class="col-12 mb-2" id="about"><?=$about ?? 'Пользователь пока не оставил о себе информацию.'?></div>
                <div class="col-12 mb-2" id="textarea" hidden>
                    <label for="about" class="form-label">Напишите что-нибудь о себе</label>
                    <textarea class="form-control" rows="5" name="about"><?=$about ?? ''?></textarea>
                </div>
            </div>
            <!--todo добавить проверку на авторизацию - пользователь этот профиль или админ-->
            <div class="row">
                <div class="col-12 mt-2">
                    <input id="edit" type="submit" class="btn btn-outline-success" value="Изменить">
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="row">
        <div class="col-4" m-1>
            <h3><?=$name?></h3>
        </div>
    </div>
<div class="row mt-2">
    <div class="col-4">
    E-mail:&nbsp;<a href="mailto:<?=$email?>"><?=$email?></a>
    </div>
</div>
<div class="row mt-2">
    <div class="col-4">
    Дата регистрации: <?=$created_at?>
    </div>
</div>
<div class="row mt-2">
    <div class="col-4">Подписка <?=!$subscribed ? 'не' : ''?> оформлена.</div>
</div>
<!--todo добавить проверку на авторизацию - пользователь этот профиль или админ-->
<div class="row">
    <div class="col-4 mt-2">
        <form method="post">
            <input type="text" name="user_id" value="<?=$id?>" hidden>
            <button type="submit" class="btn btn-outline-success btn-sm">
                <?=!$subscribed ? 'Под' : 'От'?>писаться
            </button>
        </form>
    </div>
</div>
