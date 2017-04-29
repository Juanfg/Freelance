<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'categories_projects');
    }
}
