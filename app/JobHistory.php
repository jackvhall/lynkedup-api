<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function entries()
    {
        return $this->hasMany(JobHistoryEntry::class);
    }
}
