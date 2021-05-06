<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}