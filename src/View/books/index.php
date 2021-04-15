<?php

include APP_DIR . '/layout/header.php';

echo '<h3 style="color:blue;">' . $title . '</h3>';

foreach ($books as $book) {
    echo $book->name . '. Автор: ' . $book->author . "<br>";
}

include APP_DIR . '/layout/footer.php';	
