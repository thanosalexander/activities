<?php
/**
 * Created by PhpStorm.
 * User: thanosalexander
 * Date: 11/1/2016
 * Time: 9:57 μμ
 */

namespace Thanosalexander\Activity\models;


use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'activities_types';

    protected $fillable = ['name','description','label'];

    /**
     * The activities that belongs to the type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}