<?php

namespace App;

use App\Exception\NotFoundException;

class View implements Renderable
{
    public $template;
    public $data;

    public function __construct($template, $data)
    {
        $this->template = VIEW_DIR . str_replace('.', DIRECTORY_SEPARATOR, $template) . '.php';
        $this->data = $data;
    }

    public function render()
    {
        if (file_exists($this->template)) {
            includeView($this->template, $this->data);
        } else {
            throw new NotFoundException("Страница не найдена", 404);      
        }
    }
}
