<h4>Статьи</h4>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Название</th>
        <th scope="col">Автор</th>
        <th scope="col">Обновлена</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($notes as $note) { ?>
        <tr>
            <th scope="row"><?= $note['id'] ?></th>
            <td>
                <a href="/note/<?= $note['id'] ?>">
                    <?= mb_strimwidth($note['title'], 0, 50, '...') ?>
                </a></td>
            <td>
                <a href="/profile/<?= $note['user_id'] ?>">
                    <?= $note['name'] ?>
                </a></td>
            <td>
                <?= $note['updated_at'] ?>
            </td>
            <td class="text-center">
                <form class="mb-0" method="post">
                    <button type="submit" name="delete" value="<?= $note['id'] ?>"
                            class="btn btn-outline-success btn-sm">
                        Удалить
                    </button>
                    <button type="submit" name="edit" value="<?= $note['id'] ?>"
                            class="btn btn-outline-success btn-sm">
                        Изменить
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col">
        <?= pagination($page, $notesCount, $notesPerPage, '/notes/', $sfx) ?>
    </div>
    <div class="col-2"> Отображать по
        <form method="get" id="select">
            <select class="form-select form-select-sm" id="count" name="count" aria-label="select">
                <option <?= $notesPerPage == 1 ? 'selected ' : '' ?>="1">1</option>
                <option <?= $notesPerPage == 2 ? 'selected ' : '' ?> value="2">2</option>
                <option <?= $notesPerPage == 3 ? 'selected ' : '' ?>value="3">3</option>
                <option <?= $notesPerPage == 4 ? 'selected ' : '' ?>value="4">4</option>
                <option <?= $notesPerPage == 5 ? 'selected ' : '' ?>value="5">5</option>
                <option <?= !in_array($notesPerPage, [1, 2, 3, 4, 5]) ? 'selected ' : '' ?>value="all">Все</option>
            </select>
        </form>
    </div>
</div>
<hr>
<form method="get" action="/notes/create">
    <button class="btn btn-primary">Добавить статью</button>
</form>
