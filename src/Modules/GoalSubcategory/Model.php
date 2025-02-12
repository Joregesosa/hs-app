<?php

namespace App\Modules\GoalSubcategory;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'goal_subcategories';
    protected $fillable = ['name', 'goal_category_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Modules\GoalCategory\Model', 'goal_category_id');
    }
}
