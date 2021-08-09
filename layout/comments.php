<h4>Комментарии</h4>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Автор</th>
        <th scope="col">Содержание</th>
        <th scope="col">Обновлен</th>
        <th scope="col">Опубликован</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($comments as $comment) { ?>
        <tr>
            <th scope="row"><?= $comment['id'] ?></th>
            <td><a href="/profile/<?= $comment['author_id'] ?>"><?= $comment['author'] ?></a></td>
            <td><a href="/note/<?= $comment['note_id'] ?>"><?= mb_strimwidth($comment['text'], 0, 40, '...') ?></a></td>
            <td><?= $comment['updated_at'] ?></td>
            <td><?= $comment['published'] ? 'Опубликован' : 'Нет' ?></td>

            <td class="text-center">
                <form class="mb-0" method="post">
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <?= $comment['published'] ? 'Снять с публикации' : 'Опубликовать' ?>
                    </button>
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        Удалить
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col">
        <?= pagination($page, $commentsCount, $commentsPerPage, '/comments/', $sfx) ?>
    </div>
    <div class="col-2"> Отображать по
        <form method="get" id="select">
            <select class="form-select form-select-sm" id="count" name="count" aria-label="select">
                <option <?= $commentsPerPage == 1 ? 'selected ' : '' ?>="1">1</option>
                <option <?= $commentsPerPage == 2 ? 'selected ' : '' ?> value="2">2</option>
                <option <?= $commentsPerPage == 3 ? 'selected ' : '' ?>value="3">3</option>
                <option <?= $commentsPerPage == 4 ? 'selected ' : '' ?>value="4">4</option>
                <option <?= $commentsPerPage == 5 ? 'selected ' : '' ?>value="5">5</option>
                <option <?= !in_array($commentsPerPage, [1, 2, 3, 4, 5]) ? 'selected ' : '' ?>value="all">Все</option>
            </select>
        </form>
    </div>
</div>
