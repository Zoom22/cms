<?php

include APP_DIR . '/layout/header.php';
?>
    <article class="blog-post">
        <h2 class="blog-post-title mb-4"><?=$title?></h2>
        <div class="text-start"><pre style="white-space:pre-wrap;"><?=$text?></pre></div>
    </article>
<div>Версия от <?=$updated_at?></div>
<?php
include APP_DIR . '/layout/footer.php';