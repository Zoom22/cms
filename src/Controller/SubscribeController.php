<?php

namespace App\Controller;

use App\Model\Subscriber;
use App\Model\User;

class SubscribeController extends Controller
{
    public function subscribe()
    {
        $id = intval(clean($_POST['id']));
        $subscriber = Subscriber::where('user_id', $id)->first();
        if (isset($subscriber->id)) {
            User::find($id)->update(['subscribed' => 0]);
            Subscriber::destroy($subscriber->id);
        } else {
            $user = User::find($id);
            if (!empty($user)) {
                $subscriber = new Subscriber();
                $subscriber->email = $user->email;
                $subscriber->user_id = $user->id;
                $subscriber->save();
                $user->update(['subscribed' => 1]);
            }
        }
        //todo else выкинуть Exception - пользователь не найден.
        header('location: ' . $_SERVER['REQUEST_URI']);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $subscriber = Subscriber::destroy($id);
        header('location: ' . $_SERVER['REQUEST_URI']);
    }

    public function create()
    {
        //принимает $_POST['email']
        //сделать его валидацию, проверку на повтор в таблице подписки
        //запись нового подписчика в БД
    }
}