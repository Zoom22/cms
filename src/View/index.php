<?php

include APP_DIR . '/layout/header.php';

echo '<h3 style="color:blue;">' . $title . '</h3>';
$user = isAuthorized() ? $_SESSION['user']['name'] : 'Вы не авторизованы';
echo '<div class="alert alert-success" role="alert"><strong>' . $user . '</strong></div>';

include APP_DIR . '/layout/footer.php';	
