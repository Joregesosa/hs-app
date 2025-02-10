<?php

namespace App\Modules\Service;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends Eloquent
{
    protected $table = 'services';
    protected $fillable = [
        'category_id',
        'user_id',
        'reviewer_id',
        'amount_reported',
        'evidence',
        'comment',
        'description',
        'status',
    ];
    protected $hidden = ['category_id', 'user_id', 'reviewer_id'];
    protected $appends = ['status'];
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

    public function getStatusAttribute(): string
    {
        $status = $this->attributes['status'];
        $statusName = '';
        switch ($status) {
            case 0:
                $statusName = 'Pending';
                break;
            case 1:
                $statusName = 'Approved';
                break;
            case 2:
                $statusName = 'Rejected';
                break;
        }
        return $statusName;
    }
 
}
