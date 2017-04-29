<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = ['id'];
    
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
