<?php

include APP_DIR . '/layout/header.php';

foreach ($notes as $key => $note) {
        include APP_DIR . '/layout/note.php';
}
echo '<hr class="featurette-divider">';

echo pagination($page, $notesCount, $notesPerPage, '/page/');

include APP_DIR . '/layout/subscribe.php';
include APP_DIR . '/layout/footer.php';	
