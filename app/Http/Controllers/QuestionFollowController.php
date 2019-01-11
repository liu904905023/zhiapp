<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    public $question;

    /**
     * QuestionFollowController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question) {
        $this->question = $question;
    }

    public function follow($question) {
        \Auth::user()->followThis($question);
        return back();
    }

    public function follower(Request $request) {
        $user =  \Auth::guard('api')->user();
        $follow = $user->followed($request->get('question'));
        if($follow){
            return response()->json([
                'followed' => true,
            ]);
        }
        return response()->json([
            'followed' => false,
        ]);
    }

    public function followThisQuestion(Request $request) {
        $user =  Auth::guard('api')->user();
        $question = $this->question->byid($request->get('question'));
        $followed = $user->followThis($question->id);
        if(count($followed['detached'])>0){
            $question->decrement('followers_count');
            return response()->json([
                'followed' => false,
            ]);
        }
        $question->increment('followers_count');
        return response()->json([
            'followed' => true,
        ]);
    }
}
