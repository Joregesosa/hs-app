<?php
// model class for users utilizing the Eloquent ORM

namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\School\Model as School;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Model extends Eloquent
{
    protected $table = 'users';
 
    protected $fillable = [
        'f_name',
        'm_name',
        'f_lastname',
        's_lastname',
        'email',
        'password',
        'role_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
    ];

    protected $appends = ['full_name'];

    public function role(): BelongsTo
    {
        return $this->belongsTo('App\Modules\Role\Model');
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'school_user', 'user_id', 'school_id');
    }

    // include full name attribute in the model

    public function getFullNameAttribute(): string
    {
        return "{$this->f_name} {$this->m_name} {$this->f_lastname} {$this->s_lastname}";
    }
}
