<?php

namespace App\Controller;

use App\Config;
use App\View;
use App\Model\{Page, User, Subscriber, Note};

class AdminController extends Controller
{
    //todo повторяющийся код в каждом методе унифицировать и вынести куда-нибудь
    public function users($page = 1)
    {
        function group($groupId)
        {
            switch ($groupId) {
                case 1:
                    return "Администратор";
                case 2:
                    return "Контент-менеджер";
                case 3:
                    return "Пользователь";
            }
        }
        //todo подумать на счет вывода количества статей и комментариев

        //todo подумать как хранить настойки интерфейса для текущего пользователя
        //скорее всего в куках

        $config = Config::getInstance();
        $orderBy = $config->get('admin.orderBy');
        $sortBy = $config->get('admin.sortBy');

        $usersCount = User::all()->count();
        $usersPerPage = $config->get('admin.itemsPerPage');

        if (!empty($_COOKIE['itemsPerPage'])) {
            $usersPerPage = intval($_COOKIE['itemsPerPage']);
        }

        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $usersPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $usersPerPage = $usersCount;
            }
        }
        setcookie('itemsPerPage', $usersPerPage, time() + 60 * 60 * 24 * 20, '/');
        $sfx = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
        $pages = intval(($usersCount - 1) / $usersPerPage) + 1;
        $page = ($page < 1) ? 1 : $page;
        $page = ($page > $pages) ? $pages : $page;
        $thisPageUsers = User::offset($usersPerPage * ($page - 1))
            ->limit($usersPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        $users = [];
        foreach ($thisPageUsers as $user) {
            $users[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email'  => $user->email,
                'group' => group($user->group),
                'created_at' => $user->created_at,
                'subscribed' => $user->subscribed,
            ];
        }
        return new View(
            'users',
            [
                'title' => 'Пользователи' . ($page ? ' - ' . $page : ''),
                'users' => $users,
                'page'  => $page,
                'usersCount' => $usersCount,
                'usersPerPage' => $usersPerPage,
                'sfx' => $sfx,
            ]);
    }
//может перенести в SubscribeController?
    public function subscribers($page = 1)
    {
        $config = Config::getInstance();
        $orderBy = $config->get('admin.orderBy');
        $sortBy = $config->get('admin.sortBy');

        $usersCount = Subscriber::all()->count();
        $usersPerPage = $config->get('admin.itemsPerPage');
        if (!empty($_COOKIE['itemsPerPage'])) {
            $usersPerPage = intval($_COOKIE['itemsPerPage']);
        }
        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $usersPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $usersPerPage = $usersCount;
            }
        }
        setcookie('itemsPerPage', $usersPerPage, time() + 60 * 60 * 24 * 20, '/');
        $sfx = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
        $pages = intval(($usersCount - 1) / $usersPerPage) + 1;
        $page = ($page < 1) ? 1 : $page;
        $page = ($page > $pages) ? $pages : $page;
        $thisPageUsers = Subscriber::offset($usersPerPage * ($page - 1))
            ->limit($usersPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        $users = [];
        foreach ($thisPageUsers as $user) {
            $name = is_object($user->user) ? $user->user->name : '';
            $users[] = [
                'id' => $user->id,
                'email'  => $user->email,
                'user_id' => $user->user_id,
                'name' => $name,
                'created_at' => $user->created_at,
            ];
        }

        return new View(
            'subscribers',
            [
                'title' => 'Подписчики' . ($page ? ' - ' . $page : ''),
                'users' => $users,
                'page'  => $page,
                'usersCount' => $usersCount,
                'usersPerPage' => $usersPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function notes($page = 1)
    {
        $config = Config::getInstance();
        $orderBy = $config->get('admin.orderBy');
        $sortBy = $config->get('admin.sortBy');

        $notesCount = Note::all()->count();
        $notesPerPage = $config->get('admin.itemsPerPage');
        if (!empty($_COOKIE['itemsPerPage'])) {
            $notesPerPage = intval($_COOKIE['itemsPerPage']);
        }
        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $notesPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $notesPerPage = $notesCount;
            }
        }
        setcookie('itemsPerPage', $notesPerPage, time() + 60 * 60 * 24 * 20, '/');
        $sfx = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
        $pages = intval(($notesCount - 1) / $notesPerPage) + 1;
        $page = ($page < 1) ? 1 : $page;
        $page = ($page > $pages) ? $pages : $page;
        $thisPageNotes = Note::offset($notesPerPage * ($page - 1))
            ->limit($notesPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        $notes = [];
        foreach ($thisPageNotes as $note) {
            $notes[] = [
                'id' => $note->id,
                'title'  => $note->title,
                'image' => $note->image,
                'updated_at' => $note->updated_at,
                'name' => $note->user->name,
                'user_id' => $note->user->id,
            ];
        }

        return new View(
            'notes',
            [
                'title' => 'Статьи' . ($page ? ' - ' . $page : ''),
                'notes' => $notes,
                'page'  => $page,
                'notesCount' => $notesCount,
                'notesPerPage' => $notesPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function statics($page = 1)
    {
        $config = Config::getInstance();
        $orderBy = $config->get('admin.orderBy');
        $sortBy = $config->get('admin.sortBy');

        $staticsCount = Page::all()->count();
        $staticsPerPage = $config->get('admin.itemsPerPage');
        if (!empty($_COOKIE['itemsPerPage'])) {
            $staticsPerPage = intval($_COOKIE['itemsPerPage']);
        }
        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $staticsPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $staticsPerPage = $staticsCount;
            }
        }
        setcookie('itemsPerPage', $staticsPerPage, time() + 60 * 60 * 24 * 20, '/');
        $sfx = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
        $pages = intval(($staticsCount - 1) / $staticsPerPage) + 1;
        $page = ($page < 1) ? 1 : $page;
        $page = ($page > $pages) ? $pages : $page;
        $thisPageStatics = Page::offset($staticsPerPage * ($page - 1))
            ->limit($staticsPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        $statics = [];
        foreach ($thisPageStatics as $static) {
            $statics[] = [
                'id' => $static->id,
                'title'  => $static->title,
                'updated_at' => $static->updated_at,
            ];
        }

        return new View(
            'statics',
            [
                'title' => 'Страницы' . ($page ? ' - ' . $page : ''),
                'statics' => $statics,
                'page'  => $page,
                'staticsCount' => $staticsCount,
                'staticsPerPage' => $staticsPerPage,
                'sfx' => $sfx,
            ]);
    }
}