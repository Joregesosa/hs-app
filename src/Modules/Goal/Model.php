<?php

namespace App\Modules\Goal;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'goals';
    protected $fillable = ['goal', 'user_id', 'subcategory_id', 'year'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Modules\User\Model', 'user_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Modules\GoalSubcategory\Model', 'subcategory_id');
    }

}
