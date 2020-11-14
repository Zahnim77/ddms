<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function category () 
    {
        return $this->belongsTo('App\Category');
    }

    public function tags ()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function company () 
    {
        return $this->belongsTo('App\Company');
    }
}
