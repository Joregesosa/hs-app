<?php

namespace App\Modules\Service;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends Eloquent
{
    protected $table = 'services';
    protected $fillable = ['name'];

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Modules\Category\Model');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Modules\User\Model');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo('App\Modules\User\Model');
    }
}
