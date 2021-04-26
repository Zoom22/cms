<?php
include APP_DIR . '/layout/header.php';
?>
<article class="blog-post">
    <h2 class="blog-post-title"><?=$note['title']?></h2>
    <p class="blog-post-meta"><?=$note['created_at']?> автор: <a href="/profile/<?=$note['author_id']?>"> <?=$note['author']?></a></p>

    <div><?=$note['text']?></div>
</article><!-- /.blog-post -->
<?php
include APP_DIR . '/layout/footer.php';

