<?php

namespace App\Modules\School;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'schools';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
