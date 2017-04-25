<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'categories_projects');
    }

    public function collaborators()
    {
        return $this->belongsToMany('App\User', 'collaborators_projects')->withPivot('grade');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
