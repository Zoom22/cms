<div class="row">
    <div class="col-4">
        <img src="/layout/img/nophoto.jpg" width="250" class="rounded" alt="Avatar">
    </div>
    <div class="col-8 m-auto">
        <div class="row">
            <div class="col-12 mb-2 text-info">Краткая информация:</div>
        </div>
        <div class="row">
            <div class="col-12 mb-2"><?=$about ?? 'Пользователь пока не оставил о себе информацию.'?></div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <button type="button" class="btn btn-outline-success">Изменить</button>
            </div>
        </div>
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