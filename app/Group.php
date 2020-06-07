<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
