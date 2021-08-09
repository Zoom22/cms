<h4>Информационные страницы</h4>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Название</th>
        <th scope="col">Обновлена</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($statics as $static) { ?>
        <tr>
            <th scope="row"><?= $static['id'] ?></th>
            <td><a href="/static/<?= $static['id'] ?>"><?= mb_strimwidth($static['title'], 0, 65, '...') ?></a></td>
            <td><?= $static['updated_at'] ?></td>
            <td class="text-center">

                <input type="text" name="id" value="<?= $static['id'] ?>" hidden>
                <button type="submit" class="btn btn-outline-success btn-sm"
                    <?= in_array($static['id'], [1, 2, 3]) ? 'disabled' : '' ?>>
                    Удалить
                </button>
                <button type="submit" class="btn btn-outline-success btn-sm">
                    Изменить
                </button>

            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col">
        <?= pagination($page, $staticsCount, $staticsPerPage, '/statics/', $sfx) ?>
    </div>
    <div class="col-2"> Отображать по
        <form method="get" id="select">
            <select class="form-select form-select-sm" id="count" name="count" aria-label="select">
                <option <?= $staticsPerPage == 1 ? 'selected ' : '' ?>="1">1</option>
                <option <?= $staticsPerPage == 2 ? 'selected ' : '' ?> value="2">2</option>
                <option <?= $staticsPerPage == 3 ? 'selected ' : '' ?>value="3">3</option>
                <option <?= $staticsPerPage == 4 ? 'selected ' : '' ?>value="4">4</option>
                <option <?= $staticsPerPage == 5 ? 'selected ' : '' ?>value="5">5</option>
                <option <?= !in_array($staticsPerPage, [1, 2, 3, 4, 5]) ? 'selected ' : '' ?>value="all">Все</option>
            </select>
        </form>
    </div>
</div>
