<?php

namespace Thanosalexander\Activity\models;


use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'type_id',
        'user_id',
        'content',
        'ip'
    ];

    /**
     * The type in which belong the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * The user in which belongs the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Scope a query to only include specific type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->where('votes', '>', 100);
    }


}