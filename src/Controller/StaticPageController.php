<?php

namespace App\Controller;

use App\Model\Page;
use App\View;
use App\Exception\NotFoundException;

class StaticPageController extends Controller
{
    public function create()
    {
        //вывод формы создания статичной страницы

        //проверка прав доступа
        return new View('pages.create', ['title' => 'Создание информационной страницы']);
    }

    public function store()
    {
        //валидация и сохранение в БД статичной страницы
        //проверка прав доступа
        //вывод сообщения об её адресе /cms/page/7
        $pageData = $this->validatePageData();
        if (!empty($pageData['error'])) {
            return new View(
                'pages.create',
                ['title' => 'Создание информационной страницы', 'data' => $pageData]
            );
        }
        $page = Page::create([
            'title' => $pageData['pageTitle'],
            'text' => $pageData['text'],
        ]);
        //todo проверка на успешное добавление страницы

        return new View(
            'pages.show',
            [
                'title' => $page->title,
                'text' => $page->text,
                'updated_at' => $page->updated_at,
            ]);
    }

    private function validatePageData()
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
        $result += ['pageTitle' => clean($_POST['title']), 'text' => $_POST['text']];
        return $result;
    }

    public function show($id)
    {
        $page = Page::find($id);
        if ($page) {
            return new View('pages.show', ['title' => $page->title, 'text' => $page->text, 'updated_at' => $page->updated_at]);
        } else {
            throw new NotFoundException('Cтраница не найдена', 404);
        }
    }

    public function edit()
    {
        //проверка прав доступа
        //вызов статичной страницы на редактирование
    }

    public function update()
    {
        //проверка прав доступа
        //валидация и сохранение отредактированной страницы
    }

    public function rules()
    {
        $page = Page::find(1);
        return new View('pages.show', ['title' => $page->title, 'text' => $page->text, 'updated_at' => $page->updated_at]);
    }

    public function contacts()
    {
        $page = Page::find(2);
        return new View('pages.show', ['title' => $page->title, 'text' => $page->text, 'updated_at' => $page->updated_at]);
    }

    public function about()
    {
        $page = Page::find(3);
        return new View('pages.show', ['title' => $page->title, 'text' => $page->text, 'updated_at' => $page->updated_at]);
    }
}