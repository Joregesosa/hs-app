<?php

namespace App\Modules\Role;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
