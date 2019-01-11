<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 16:15
 */

namespace App\Repositories;


use App\Message;

class MessageRepository {
    public function create(array  $message) {
        return Message::create($message);
    }
}