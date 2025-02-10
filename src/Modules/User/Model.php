<?php
// model class for users utilizing the Eloquent ORM

namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\School\Model as School;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'password',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['full_name', 'status'];

    public function role(): BelongsTo
    {
        return $this->belongsTo('App\Modules\Role\Model');
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'school_user', 'user_id', 'school_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany('App\Modules\Service\Model', 'user_id');
    }

    public  function student(): HasOne
    {
        return $this->hasOne('App\Modules\Student\Model', 'user_id');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->f_name} {$this->m_name} {$this->f_lastname} {$this->s_lastname}";
    } 

    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] == 1 ? 'activo' : 'inactivo';
    }
}
