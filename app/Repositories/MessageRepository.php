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

    public function getAllMessages() {
        return Message::where('to_user_id', user()->id)->orwhere('from_user_id', user()->id)->with([
                'fromUser' => function ($query) {
                    return $query->select(['id', 'name', 'avatar']);
                },
                'toUser'   => function ($query) {
                    return $query->select(['id', 'name', 'avatar']);
                }
            ])->latest()->get();
    }

    public function getMessagesByDialog($dialog) {
        return Message::where('dialog_id', $dialog)->with([
            'fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            },
            'toUser'   => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }
        ])->latest()->get();
    }

    public function getSingleMessageByDialogId($dialog) {
        return Message::where('dialog_id', $dialog)->first();
    }
}