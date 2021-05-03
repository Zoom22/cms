<?php

namespace App\Controller;

use App\Config;
use App\Exception\NotFoundException;
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

            ];
            return new View('notes.show', ['title' => $note['title'], 'note' => $note]);
        } else {
            throw new NotFoundException('Статья не найдена', 404);
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        $note = Note::destroy($id);
        header('location: ' . $_SERVER['REQUEST_URI']);
    }
}