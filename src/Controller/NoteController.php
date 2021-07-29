<?php

namespace App\Controller;

use App\Config;
use App\Exception\NotFoundException;
use App\Model\Comment;
use App\View;
use App\Model\Note;

class NoteController extends Controller
{
    public function showAll($page = 1)
    {
        $config = Config::getInstance();
        $orderBy = $config->get('pagination.orderBy');
        $sortBy = $config->get('pagination.sortBy');

        $notesPerPage = $config->get('pagination.notesPerPage');
        $notesCount = Note::all()->count();
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
                'text'  => $note->text,
                'image' => $note->image,
                'created_at' => $note->created_at,
            ];
        }
        return new View(
            'index',
            [
                'title' => 'Статьи' . ($page ? ' - ' . $page : ''),
                'notes' => $notes,
                'page'  => $page,
                'notesCount' => $notesCount,
                'notesPerPage' => $notesPerPage,
            ]);
    }

    public function show($id)
    {
        $thisPageNote = Note::find($id);
        if ($thisPageNote) {
            $note = [
                'title' => $thisPageNote->title,
                'text' => $thisPageNote->text,
                'created_at' => $thisPageNote->created_at,
                'author' => $thisPageNote->user->name,
                'author_id' => $thisPageNote->user->id,
                'id' => $id,

            ];
//        $comments = Comment::join('users', 'author_id', '=', 'users.id')
//            ->select('comments.*', 'users.name as author', 'users.photo')
//            ->where('note_id', $id)
//            ->get();
            $comments = CommentController::getComments($id);
            return new View('notes.show', ['title' => $note['title'], 'note' => $note, 'comments' => $comments]);
        } else {
            throw new NotFoundException('Статья не найдена', 404);
        }
    }

    public function edit($id)
    {
        if (!UserController::isModerator()) {
            throw new \App\Exception\ForbiddenException("Недостаточно прав.", 403);
        }
        //вывод формы для создания страницы с загрузкой картинки
        $thisPageNote = Note::find($id);
        if ($thisPageNote) {
            $note = [
                'title' => $thisPageNote->title,
                'text' => $thisPageNote->text,
                'id' => $id,

            ];
        return new View('notes.edit', ['title' => 'Изменение записи в блоге', 'note' => $note]);
    } else {
            throw new NotFoundException('Статья не найдена', 404);
        }
    }

    public function update($id)
    {
        if (!UserController::isModerator()) {
            throw new \App\Exception\ForbiddenException("Недостаточно прав.", 403);
        }
        //валидация и сохранение статьи, картинки и автора
        //вывод сообщения об её адресе /cms/page/7
        $noteData = $this->validateNoteData();
        if (!empty($noteData['error'])) {
            $noteData['id'] = $id;
            return new View(
                'notes.edit',
                ['title' => 'Изменение записи в блоге', 'note' => $noteData]
            );
        }

        $note = Note::find($id);
        if ($note) {
            $note->title = $noteData['title'];
            $note->text = $noteData['text'];
            $note->save();
            return $this->show($id);
        } else {
            throw new NotFoundException('Статья не найдена', 404);
        }
//            new View(
//            'notes.show',
//            [
//                'title' => $note->title,
//                'note' => $note,
//            ]);

    }

    public function delete()
    {
        if (!UserController::isModerator()) {
            throw new \App\Exception\ForbiddenException("Недостаточно прав.", 403);
        }
        if (isset($_POST['edit'])) {
            //todo валидация данных
            header('location: /notes/' . $_POST['edit'] . '/edit');
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['delete']; //todo валидация данных
            Note::destroy($id);
            header('location: ' . $_SERVER['REQUEST_URI']);
        } else {
            throw new NotFoundException('Статья не найдена', 404);
        }
    }

    public function create()
    {
        if (!UserController::isModerator()) {
            throw new \App\Exception\ForbiddenException("Недостаточно прав.", 403);
        }
        //вывод формы для создания страницы с загрузкой картинки

        return new View('notes.create', ['title' => 'Новая запись в блоге']);
    }

    public function store()
    {
        if (!UserController::isModerator()) {
            throw new \App\Exception\ForbiddenException("Недостаточно прав.", 403);
        }
        //валидация и сохранение статьи, картинки и автора

        //вывод сообщения об её адресе /cms/page/7
        $noteData = $this->validateNoteData();
        if (!empty($noteData['error'])) {
            return new View(
                'notes.create',
                ['title' => 'Новая запись в блоге', 'data' => $noteData]
            );
        }
        $note = Note::create([
            'title' => $noteData['title'],
            'text' => $noteData['text'],
            'user_id' => $_SESSION['user']['id'],
        ]);
        //todo проверка на успешное добавление страницы

        return new View(
            'notes.show',
            [
                'title' => $note->title,
                'note' => $note,
            ]);
    }

    private function validateNoteData()
    {
        $result = ['error' => ''];
        if (empty($_POST)) {
            $result['error'] = 'Заполните заголовок страницы и её содержание';
            return $result;
        } elseif (empty($_POST['title'])) {
            $result['error'] = 'Заполните заголовок страницы';
        } elseif (empty($_POST['text'])) {
            $result['error'] = 'Содержание страницы не может быть пустым';
        }
        $result += ['title' => clean($_POST['title']), 'text' => $_POST['text']];
        return $result;
    }
}