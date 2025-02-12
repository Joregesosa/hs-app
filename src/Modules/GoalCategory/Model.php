<?php

namespace App\Modules\GoalCategory;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'goal_categories';
    protected $fillable = ['name', 'description'];
    protected $hidden = ['created_at', 'updated_at'];
}
