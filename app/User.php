<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','is_active','settings','api_token','settings'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'settings' => 'array'
    ];

    public function setting() {
        return new Setting($this);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param Model $model
     * @return bool
     */
    public function owns(Model $model) {
        return $this->id == $model->user_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows() {
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers() {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followersUser() {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * @param $question
     * @return array
     */
    public function followThis($question) {
        return $this->follows()->toggle($question);
    }

    /**
     * @param $question
     * @return int
     */
    public function followed($question) {
        return $this->follows()->where('question_id', $question)->count();
    }

    /**
     * @param $user
     * @return array
     */
    public function followThisUser($user) {
        return $this->followers()->toggle($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes() {
        return $this->belongsToMany(Answer::class, 'votes')->withTimestamps();
    }

    /**
     * @param $answer
     * @return array
     */
    public function voteFor($answer) {
        return $this->votes()->toggle($answer);
    }

    /**
     * @param $answer
     * @return int
     */
    public function hasVoteFor($answer) {
        return $this->votes()->where('answer_id', $answer)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class,'to_user_id');
    }
}
