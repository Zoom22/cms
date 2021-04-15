<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['photo', 'group'];

    public function authorize(bool $setCookie = false)
    {
        $_SESSION['user'] = [
            'authorized' => true,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'group' => $this->group,
        ];

        if ($setCookie) {
            setcookie('email', $this->email, time()+60*60*24*30, "/");
        }
    }
}
