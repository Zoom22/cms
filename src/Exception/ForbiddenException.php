<?php

namespace App\Exception;

use App\Renderable;

class ForbiddenException extends HttpException implements Renderable
{
    public function render()
    {
        $title = "Доступ запрещен";
        include APP_DIR . '/layout/header.php';
        echo "<h2 style='color:red;'>Ошибка. Недостаточно прав для просмотра страницы.</h2>";
        include APP_DIR . '/layout/footer.php';
    }
}
