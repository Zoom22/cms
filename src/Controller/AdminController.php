<?php

namespace App\Controller;

use App\Config;
use App\Exception\ForbiddenException;
use App\View;
use App\Model\{Comment, Page, User, Subscriber, Note};

class AdminController extends Controller
{
    //todo повторяющийся код в каждом вынести куда-нибудь
    public function users($page = 1)
    {
        if (!UserController::isAdmin()) {
            throw new ForbiddenException("Недостаточно прав.", 403);
        }

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
        $users = [];
        $thisPageUsers = User::select(User::raw('    `users`.*,
    (SELECT 
            COUNT(`notes`.`id`)
        FROM
            `notes`
        WHERE
            `users`.`id` = `notes`.`user_id`) AS notesCount,
    (SELECT 
            COUNT(`comments`.`id`)
        FROM
            `comments`
        WHERE
            `users`.`id` = `comments`.`author_id`) AS commentsCount'))
            ->offset($usersPerPage * ($page - 1))
            ->limit($usersPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        foreach ($thisPageUsers as $user) {
            $users[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'group' => $user->group,
                'created_at' => $user->created_at,
                'subscribed' => $user->subscribed,
                'notesCount' => $user->notesCount,
                'commentsCount' => $user->commentsCount,
            ];
        }
        return new View(
            'users',
            [
                'title' => 'Пользователи' . ($page ? ' - ' . $page : ''),
                'users' => $users,
                'activeUserId' => $_SESSION['user']['id'],
                'page' => $page,
                'usersCount' => $usersCount,
                'usersPerPage' => $usersPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function subscribers($page = 1)
    {
        if (!UserController::isAdmin()) {
            throw new ForbiddenException("Недостаточно прав.", 403);
        }

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
                'email' => $user->email,
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
                'page' => $page,
                'usersCount' => $usersCount,
                'usersPerPage' => $usersPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function notes($page = 1)
    {
        if (!UserController::isModerator()) {
            throw new ForbiddenException("Недостаточно прав.", 403);
        }

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
                'title' => $note->title,
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
                'page' => $page,
                'notesCount' => $notesCount,
                'notesPerPage' => $notesPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function comments($page = 1)
    {
        if (!UserController::isModerator()) {
            throw new ForbiddenException("Недостаточно прав.", 403);
        }

        $config = Config::getInstance();
        $orderBy = $config->get('admin.orderBy');
        $sortBy = $config->get('admin.sortBy');

        $commentsCount = Comment::all()->count();
        $commentsPerPage = $config->get('admin.itemsPerPage');
        if (!empty($_COOKIE['itemsPerPage'])) {
            $commentsPerPage = intval($_COOKIE['itemsPerPage']);
        }
        if (isset($_GET['count'])) {
            if (intval($_GET['count']) >= 1) {
                $commentsPerPage = intval($_GET['count']);
            }
            if ($_GET['count'] === "all") {
                $commentsPerPage = $commentsCount;
            }
        }
        setcookie('itemsPerPage', $commentsPerPage, time() + 60 * 60 * 24 * 20, '/');
        $sfx = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
        $pages = intval(($commentsCount - 1) / $commentsPerPage) + 1;
        $page = ($page < 1) ? 1 : $page;
        $page = ($page > $pages) ? $pages : $page;
        $thisPageComments = Comment::join('users', 'author_id', '=', 'users.id')
            ->select('comments.*', 'users.name as author')
            ->offset($commentsPerPage * ($page - 1))
            ->limit($commentsPerPage)
            ->orderBy($sortBy, $orderBy)
            ->get();
        $comments = [];
        foreach ($thisPageComments as $comment) {
            $comments[] = [
                'id' => $comment->id,
                'author' => $comment->author,
                'author_id' => $comment->author_id,
                'note_id' => $comment->note_id,
                'text' => $comment->text,
                'updated_at' => $comment->updated_at,
                'published' => $comment->published,
            ];
        }

        return new View(
            'comments',
            [
                'title' => 'Страницы' . ($page ? ' - ' . $page : ''),
                'comments' => $comments,
                'page' => $page,
                'commentsCount' => $commentsCount,
                'commentsPerPage' => $commentsPerPage,
                'sfx' => $sfx,
            ]);
    }

    public function statics($page = 1)
    {
        if (!UserController::isModerator()) {
            throw new ForbiddenException("Недостаточно прав.", 403);
        }

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
                'title' => $static->title,
                'updated_at' => $static->updated_at,
            ];
        }

        return new View(
            'statics',
            [
                'title' => 'Страницы' . ($page ? ' - ' . $page : ''),
                'statics' => $statics,
                'page' => $page,
                'staticsCount' => $staticsCount,
                'staticsPerPage' => $staticsPerPage,
                'sfx' => $sfx,
            ]);
    }
}
