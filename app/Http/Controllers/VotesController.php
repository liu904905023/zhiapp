<?php

namespace App\Http\Controllers;

use App\Repositories\AnswersRepository;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public $answer;

    /**
     * VotesController constructor.
     * @param $answer
     */
    public function __construct(AnswersRepository $answer) {
        $this->answer = $answer;
    }

    public function index($id) {
        $user = \Auth::guard('api')->user();
        if ($user->hasVoteFor($id)) {
            return response()->json([
                'voted' => true,
            ]);
        }
        return response()->json([
            'voted' => false,
        ]);
        
        
    }

    public function vote(Request $request) {
        $answer = $this->answer->byId($request->get('answer'));
        $voted = \Auth::guard('api')->user()->voteFor($request->get('answer'));
        if(count($voted['attached'])>0){
            $answer->increment('votes_count');
            return response()->json([
                'voted' => true,
            ]);
        }
        $answer->decrement('votes_count');
        return response()->json([
            'voted' => false,
        ]);
    }
}
