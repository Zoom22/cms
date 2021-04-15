<?php

namespace App\Controller;

use App\Model\Book;

class Main
{
    public function index()
    {
        return 'home';
    }

    public function about()
    {
        return 'about';
    }

    public function readBooks($params = 'all')
    {
        if ($params === 'new'){
            return new View('books.index', ['title' => 'Наши новинки', 'books' => Book::where('new', 1)->get()]);
        } else {
            return new View('books.index', ['title' => 'Все книги', 'books' => Book::all()]); 
        }
    }

    public function auth()
    {
        //todo проверить авторизован ли пользователь
            return new View('auth', ['title' => 'Авторизация']);
    } 

    public function register()
    {
        //todo проверить авторизован ли пользователь
            return new View('register', ['title' => 'Регистрация']);
    } 
}
