<?php

namespace App\Controller;

use App\Model\Subscriber;
use App\Model\User;

class SubscribeController extends Controller
{
    public function subscribe()
    {
        $id = isset($_POST['id']) ? intval(clean($_POST['id'])) : 0;
        $userId = isset($_POST['user_id']) ? intval(clean($_POST['user_id'])) : 0;

        if (!empty($id)) {
            Subscriber::destroy($id);
        }
        if (!empty($userId)) {
            $user = User::find($userId);
            if ($user->subscribed) {
                $user->update(['subscribed' => 0]);
                Subscriber::where('email', $user->email)->delete();
            } else {
                $user->update(['subscribed' => 1]);
                $subscriber = new Subscriber();
                $subscriber->email = $user->email;
                $subscriber->user_id = $user->id;
                $subscriber->save();
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
        $error = "";
        $email = !empty($_POST['email']) ? clean($_POST['email']) : '';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Введите корректный E-mail адрес. <br>";
        } elseif (!empty(Subscriber::where('email', $email)->first())) {
            $error = "На указанный E-mail адрес подписка уже оформлена. <br>";
        }
        if (empty($error)) {
            $subscriber = new Subscriber();
            $subscriber->email= $email;
            $user = User::where('email', $email)->first ();
            if (!empty($user)) {
                $user->update(['subscribed' => 1]);
                $subscriber->user_id = $user->id;
            }
            $subscriber->save();
        } else {
            echo $error;
        }
    }
}