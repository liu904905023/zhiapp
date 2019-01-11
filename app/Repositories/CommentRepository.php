<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 14:15
 */

namespace App\Repositories;


use App\Comment;

class CommentRepository {
    public function create(array $attributes) {
        return Comment::create($attributes);
    }

}