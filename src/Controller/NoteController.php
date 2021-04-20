<?php

namespace App\Controller;

use App\Config;
use App\Exception\NotFoundException;
use App\View;
use App\Model\Note;

class NoteController
{
    public function showAll()
    {
        session_start(); //todo где общая точка входа?
        $config = Config::getInstance();
        $notesPerPage = $config->get('notesPerPage');
        $notesCount = Note::all()->count();
        $thisPageNotes = Note::where('id', '>', '0')
        ->orderBy('created_at', 'desc')
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
        return new View('index', ['title' => 'Главная страница', 'notes' => $notes]);
    }

}