<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Имя</th>
        <th scope="col">E-mail</th>
        <th scope="col">Роль</th>
        <th scope="col">Зарегистрирован</th>
        <th scope="col" class="text-center">Подписка</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user){ ?>
        <tr>
            <th scope="row"><?=$user['id']?></th>
            <td><a href="/profile/<?=$user['id']?>"><?=$user['name']?></a></td>
            <td><?=$user['email']?></td>
            <td><?=$user['group']?></td>
            <td><?=$user['created_at']?></td>
            <td class="text-center">
                <form class="mb-0" method="post">
                    <input type="text" name="id" value="<?=$user['id']?>" hidden>
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <?=$user['subscribed'] ? 'Подписан' : 'Не подписан'?>
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div class="d-flex justify-content-start">
<?=pagination($page, $usersCount, $usersPerPage, '/users/')?>
</div>
<div class="d-flex justify-content-end">
    <select class="form-select form-select-sm justify-content-end" aria-label="Default select example">
        <option selected>Отображать по ...</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="all">Все</option>
    </select>
</div>
