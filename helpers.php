<?php

use \App\Model\User;

function array_get($array, $key, $default = null)
{
    $keys = explode('.', $key);
    $result = $array;
    foreach ($keys as $key) {
        if (!isset($result[$key])) {
            return $default;
        }
        $result = $result[$key];
    }

    return $result;
}

function includeView($templateName, $data)
{

    extract($data);
    include $templateName;
}

function loginUser(User $user)
{
    $_SESSION['user'] = $user;
    $_SESSION['email'] = $user->email;
    $_SESSION['login'] = true;
    if (isset($_COOKIE['userLogin']) && $_COOKIE['userLogin'] !== $user->email) {
        setcookie('itemsPerPage', $user->email, 1);
    }
    setcookie('userLogin', $user->email, time() + 60 * 60 * 24 * 20, '/');
}

function clean($value = '')
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

function isAuthorized()
{
    return !empty($_SESSION['user']['authorized']);
}

/*
*
* Формирование ссылок для пагинации
*
* @param integer $page номер текущей страницы
* @param integer $items общее количество элементов
* @param integer $itemsPerPage количество элементов на одной странице
* @param string $baseUrl URL для присоединения параметра пагинации
*
* @return string
*
*/
function pagination($page, $items, $itemsPerPage, $baseUrl, $sfx = '')
{
    $pages = intval(($items - 1) / $itemsPerPage) + 1;
    if ($pages == 1) {
        return '';
    }
    $page = ($page < 1) ? 1 : $page;
    $page = ($page > $pages) ? $pages : $page;
    $pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    if ($pages != 1) {
        if ($page > 1) {
            $previous = $page - 1;
            $pagination .= '<li class="page-item">
                                <a class="page-link" href="' . $baseUrl . $previous . $sfx . '">Предыдущая</a>
                            </li>';
            for ($i = $page - 3; $i < $page; $i++) {
                if ($i > 0) {
                    $pagination .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . $i . $sfx . '">' . $i . '</a></li>';
                }
            }
        }
        $pagination .= '<li class="page-item active" aria-current="page">
                            <span class="page-link">' . $page . '</span>
                        </li>';
        for ($i = $page + 1; $i <= $pages; $i++) {
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . $i . $sfx . '">' . $i . '</a></li>';
            if ($i >= $page + 3) {
                break;
            }
        }
        if ($page != $pages) {
            $next = $page + 1;
            $pagination .= '<li class="page-item">
                                <a class="page-link" href="' . $baseUrl . $next . $sfx . '">Следующая</a>
                            </li>';
        }
    }
    $pagination .= '</nav></ul>';

    return $pagination;
}

function isActiveMenu($link)
{
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $link = trim($link, '/');
    if ($link == $uri || preg_match('/^' . $link . '\/\w+/', $uri)) {
        return 'active';
    } elseif ($link == '' && preg_match('/^page\/\w+/', $uri)) {
        return 'active';
    } else {
        return '';
    }
}