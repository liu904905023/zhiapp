<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public $message;

    /**
     * MessagesController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message) {
        $this->message = $message;
    }

    public function send() {

        $from_user_id = \Auth::guard('api')->user()->id;
        $to_user_id = request('user');
        $body = request('body');
        $message = $this->message->create([
            'from_user_id' => $from_user_id,
            'to_user_id' => $to_user_id,
            'body' => $body,
        ]);
        if ($message) {
            return response()->json([
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }
}
