<?php

namespace App\Controller;

use App\Config;
use App\View;
use App\Model\{User, Subscriber};

class AdminController extends Controller
{
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

        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $usersPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $usersPerPage = $usersCount;
            }
        }
        $sfx = '?' . $_SERVER['QUERY_STRING'];
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

        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $usersPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $usersPerPage = $usersCount;
            }
        }
        $sfx = '?' . $_SERVER['QUERY_STRING'];
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
}