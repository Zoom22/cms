<?php

namespace App\Controller;

use App\Model\Comment;
use App\View;

class CommentController extends Controller
{
    public function store()
    {
        //запись комментария в БД


        //валидация данных из POST
        //проверка на авторизацию и прав на добавление комментария
        //установка флага published взависимости от прав пользователя
        $published = 0;
        $comment = Comment::create([
            'author_id' => $_SESSION['user']['id'],
            'text' => $_POST['text'],
            'note_id' => $_POST['note_id'],
            'published' => $published,
        ]);
        header('location: ' . $_SERVER['REQUEST_URI']);
    }

    public static function getComments($noteId)
    {
        //выборка комментарев для статьи в зависимости от пользователя
        /*
         * 1. Админ или модератор - все
         * 2. Владелец - опубликованные и свои
         * 3. Незарегистрированный - опубликованные
         */

        if (UserController::isModerator()) {
            $comments = Comment::join('users', 'author_id', '=', 'users.id')
                ->select('comments.*', 'users.name as author', 'users.photo')
                ->where('note_id', $noteId)
                ->get();
        } elseif (isAuthorized()) {
            $comments = Comment::join('users', 'author_id', '=', 'users.id')
                ->select('comments.*', 'users.name as author', 'users.photo')
                ->where('note_id', $noteId)
                ->where(function($query)
                {
                    $query->where('comments.published', 1)
                        ->orWhere('comments.author_id', $_SESSION['user']['id']);
                })
                ->get();
        } else {
            $comments = Comment::join('users', 'author_id', '=', 'users.id')
                ->select('comments.*', 'users.name as author', 'users.photo')
                ->where('note_id', $noteId)
                ->where('published', 1)
                ->get();
        }

        return $comments;
    }

    public static function getCommentsCount($noteId)
    {
        //подсчет количества комметариев для статьи.
    }
}