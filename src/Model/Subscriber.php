<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $guarded = ['id', 'email'];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
