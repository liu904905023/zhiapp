<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28
 * Time: 15:47
 */

namespace App\Repositories;


use App\Answer;

class AnswersRepository {
    public function create(array $data) {
        return Answer::create($data);
    }
}