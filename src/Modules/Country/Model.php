<?php

namespace App\Modules\Country;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'countries';
    protected $fillable = ['name'];
}
