<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Topic
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic query()
 * @mixin \Eloquent
 */
class Topic extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'questions_count'
    ];

    public function questions() {

        return $this->belongsToMany(Question::class)->withTimestamps();

    }

}
