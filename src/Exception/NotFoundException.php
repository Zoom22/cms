<?php

namespace App\Exception;

use App\Renderable;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        $title = "Страница не найдена";
        include APP_DIR . '/layout/header.php';
        echo "<h2 style='color:red;'>Ошибка. Страница не найдена.</h2>";
        include APP_DIR . '/layout/footer.php';
    }
}
