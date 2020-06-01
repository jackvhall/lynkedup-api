<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobHistoryEntry extends Model
{
    protected $guarded = [];

    public function history()
    {
        return $this->belongsTo(JobHistory::class);
    }
}
