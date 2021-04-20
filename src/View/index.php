<?php

include APP_DIR . '/layout/header.php';
//
//echo '<h3 style="color:blue;">' . $title . '</h3>';
//$user = isAuthorized() ? $_SESSION['user']['name'] : 'Вы не авторизованы';
//echo '<div class="alert alert-success" role="alert"><strong>' . $user . '</strong></div>';

foreach ($notes as $key => $note) {
        include APP_DIR . '/layout/note.php';
}
echo '<hr class="featurette-divider">';
include APP_DIR . '/layout/footer.php';	
