<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

/**
 * Class InBoxController
 * @package App\Http\Controllers
 */
class InBoxController extends Controller
{

    /**
     * @var MessageRepository
     */
    protected $message;
    /**
     * InBoxController constructor.
     */
    public function __construct(MessageRepository $message) {
        $this->middleware('auth');
        $this->message = $message;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
//        $messages = user()->messages->groupBy('from_user');
        $messages = $this->message->getAllMessages();
//        return $messages;
//        dd($messages) ;
//        $json = $messages->toJson();
        return view('inbox.index',['messages'=>$messages->groupBy('dialog_id')]);
    }

    /**
     * @param $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($dialog) {
        $messages = $this->message->getMessagesByDialog($dialog);
        $messages->markAsRead();
        return view('inbox.show', compact('messages','dialog'));
    }

    /**
     * @param $dialog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($dialog) {
        $messages = $this->message->getSingleMessageByDialogId($dialog);
        $newMessage = $this->message->create([
            'body'         => request('body'),
            'to_user_id'   => $messages->to_user_id,
            'from_user_id' => user()->id,
            'dialog_id'    => $dialog
        ]);
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
        return back();
    }
}
