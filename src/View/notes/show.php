<?php
include APP_DIR . '/layout/header.php';
?>
    <article class="blog-post">
        <h2 class="blog-post-title"><?= $note['title'] ?></h2>
        <p class="blog-post-meta"><?= $note['created_at'] ?> автор: <a
                    href="/profile/<?= $note['author_id'] ?>"> <?= $note['author'] ?></a></p>

        <div><?= $note['text'] ?></div>
    </article>
    <div class="mt-5">
        <h6 class="text-uppercase text-muted mb-4">
            <?= !empty($comments) && count($comments) > 0 ? 'Комментариев - ' . count($comments) : 'Комментариев нет' ?>
        </h6>
        <?php
        foreach ($comments as $comment) { ?>
            <div class="d-flex mb-4">
                <img class="avatar avatar-lg p-1 flex-shrink-0 me-4"
                     src="/layout/img/photo/<?= $comment->photo ?>" width="55" height="55"
                     alt="<?= $comment->author ?>">
                <div>
                    <h5><?= $comment->author ?></h5>
                    <p class="text-uppercase text-sm text-muted"><i
                                class="far fa-clock"></i> <?= $comment->created_at ?></p>
                    <p class="text-muted"><?= $comment->text ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <form class="form-signin" method="post" action="/note/<?= $note['id'] ?>">
        <div class="text-center">
            <h5 class="h3 mt-3 font-weight-normal">Оставить комментарий к статье:</h5>
            <?php if (!empty($data['error'])) { ?>
                <div class="alert alert-danger" role="alert"><?= $data['error'] ?></div>
            <?php } ?>
        </div>
        <!--        todo добавить required к полям формы-->
        <div class="form-label-group">
            <input name="note_id" value="<?= $note['id'] ?? false ?>" hidden>
            <label for="text" class="mt-3">Текст комментария</label>
            <textarea rows="4" cols="10" id="text" class="form-control" placeholder="Текст комментария" name="text"
                      value="<?= $data['text'] ?? '' ?>"><?= $data['text'] ?? '' ?></textarea>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Сохранить</button>
    </form>
<?php
include APP_DIR . '/layout/footer.php';

