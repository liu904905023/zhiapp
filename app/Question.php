<?php

namespace App;

use App\Events\StoreQuestionEvent;
use Illuminate\Database\Eloquent\Model;
use App\Topic;

/**
 * App\Question
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question query()
 * @mixin \Eloquent
 */
class Question extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public static function insert($data) {
        $question = static::create($data);
//       $aaa = event(new StoreQuestionEvent($question));
        return $question;
    }

    public function topics() {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function scopePublished($query) {
        return $query->where('is_hidden','F');
    }
}
