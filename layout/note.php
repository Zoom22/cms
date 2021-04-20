<hr class="featurette-divider">

<div class="row">
    <div class="col-md-7 <?=($key % 2) ? ' order-md-2' : ''?>">
        <h4><?=$note['title']?></h4>
        <p class="text-start"><?= mb_strimwidth($note['text'], 0, 200, '...')?></p>
        <a href="/note/<?=$note['id']?>">Подробнее ...</a>
        <p class="text-end"><?=$note['created_at']?></p>
    </div>
    <div class="col-md-5 <?=($key % 2) ? ' order-md-1' : ''?>">
        <img src="/layout/img/notes_img/<?=$note['image']?>" class="rounded" width="300" alt="Изображение статьи">
    </div>
</div>