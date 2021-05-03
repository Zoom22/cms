<?php

namespace App\Controller;

use App\Model\Subscriber;
use App\Model\User;

class SubscribeController extends Controller
{
    public function subscribe()
    {
        $id = $_POST['id'];
        $user = User::find($id);
        if (!empty($user)) {
            if ($user->subscribed) {
                $user->subscribed = 0;
            } else {
                $user->subscribed = 1;
            }
            $user->save();
        }
        //todo else выкинуть Exception - пользователь не найден.
//        header('location: /profile/' . $id);
        header('location: ' . $_SERVER['REQUEST_URI']);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $subscriber = Subscriber::destroy($id);
        header('location: ' . $_SERVER['REQUEST_URI']);
    }
}