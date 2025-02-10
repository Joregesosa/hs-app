<?php

namespace App\Modules\Student;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends Eloquent
{
    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'controller_id',
        'recruiter_id',
        'country_id',
    ];

    protected $hidden = [
        'user_id',
        'controller_id',
        'recruiter_id',
        'country_id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Modules\User\Model', 'user_id');
    }

    public function controller(): BelongsTo
    {
        return $this->belongsTo('App\Modules\User\Model', 'controller_id');
    }

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo('App\Modules\User\Model', 'recruiter_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo('App\Modules\Country\Model', 'country_id');
    }
}
