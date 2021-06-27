<hr class="featurette-divider">

<div class="row">
    <div class="col-md-7 <?=($key % 2) ? ' order-md-2' : ''?>">
        <h4><a href="/note/<?=$note['id']?>"><?=$note['title']?></a></h4>
        <p class="text-start"><?= mb_strimwidth($note['text'], 0, 200, '...')?></p>
        <small><?=$note['created_at']?> </small><a href="/note/<?=$note['id']?>">Подробнее ...</a><br>

    </div>
    <div class="col-md-5 <?=($key % 2) ? ' order-md-1' : ''?>">
        <a href="/note/<?=$note['id']?>">
            <img src="/layout/img/notes_img/<?=$note['image']?>" class="rounded" width="300" alt="Изображение статьи">
        </a>
    </div>
</div>