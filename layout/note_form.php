<form class="form-signin" method="post" action="/notes/store">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Добавление новой записи в блог</h1>
        <?php if (!empty($data['error'])) { ?>
            <div class="alert alert-danger" role="alert"><?=$data['error']?></div>
        <?php } ?>
    </div>
    <!--        todo добавить required к полям формы-->
    <div class="form-label-group">
        <label for="title">Заголовок</label>
        <input type="text" id="title" class="form-control" placeholder="Заголовок" name="title" value="<?=$data['pageTitle'] ?? ''?>" autofocus>
    </div>

    <div class="form-label-group">
        <label for="text" class="mt-3">Текст записи</label>
        <textarea rows="12" id="text" class="form-control" placeholder="Текст страницы" name="text" value="<?=$data['text'] ?? ''?>" autofocus><?=$data['text'] ?? ''?></textarea>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Сохранить</button>
</form>
