<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/15
 * Time: 14:23
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection {
    public function markAsRead() {
        $this->each(function($message){
            if ($message->to_user_id == user()->id) {
                $message->markAsread();

            }
        });


    }
}