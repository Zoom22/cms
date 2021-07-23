<h4>Зарегистрированные пользователи</h4>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Имя</th>
        <th scope="col">E-mail</th>
        <th scope="col">Роль</th>
        <th scope="col">Зарегистрирован</th>
        <th scope="col">Статей / Комментариев</th>
        <th scope="col" class="text-center">Подписка</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user){ ?>
        <tr>
            <th scope="row"><?=$user['id']?></th>
            <td><a href="/profile/<?=$user['id']?>"><?=$user['name']?></a></td>
            <td><?=$user['email']?></td>
            <td>
                <form method="post">
                    <select class="form-select form-select-sm group" data-user_id="<?=$user['id']?>" <?=$activeUserId == $user['id'] ? 'disabled' : ''?>>
                        <option <?=$user['group'] == 1 ? 'selected ' : ''?>value="1">Администратор</option>
                        <option <?=$user['group'] == 2 ? 'selected ' : ''?>value="2">Контент-менеджер</option>
                        <option <?=$user['group'] == 3 ? 'selected ' : ''?>value="3">Пользователь</option>
                    </select>
                </form>
            </td>
            <td><?=$user['created_at']?></td>
            <td><?=$user['notesCount'] . ' / ' . $user['commentsCount']?></td>
            <td class="text-center">
                <form class="mb-0" method="post">
                    <input type="text" name="user_id" value="<?=$user['id']?>" hidden>
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <?=$user['subscribed'] ? 'Подписан' : 'Не подписан'?>
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col">
        <?=pagination($page, $usersCount, $usersPerPage, '/users/', $sfx)?>
    </div>
    <div class="col-2"> Отображать по
        <form method="get" id="select">
        <select class="form-select form-select-sm" id="count" name="count" aria-label="select">
            <option <?=$usersPerPage == 1 ? 'selected ' : ''?>value="1">1</option>
            <option <?=$usersPerPage == 2 ? 'selected ' : ''?>value="2">2</option>
            <option <?=$usersPerPage == 3 ? 'selected ' : ''?>value="3">3</option>
            <option <?=$usersPerPage == 4 ? 'selected ' : ''?>value="4">4</option>
            <option <?=$usersPerPage == 5 ? 'selected ' : ''?>value="5">5</option>
            <option <?=!in_array($usersPerPage, [1,2,3,4,5]) ? 'selected ' : ''?>value="all">Все</option>
        </select>
        </form>
    </div>
</div>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body" id="notification">
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
</div>
