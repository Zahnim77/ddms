<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function jobs ()
    {
        return $this->belongsToMany('App\Job');
    }
}
