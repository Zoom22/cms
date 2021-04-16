<?php

namespace App\Controller;

use App\Model\User;

class SubscribeController
{
    public function subscribe($id)
    {
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
        header('location: /profile/' . $id);
    }
}