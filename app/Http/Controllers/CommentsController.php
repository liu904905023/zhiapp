<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Question;
use App\Repositories\AnswersRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public $answer;
    public $question;
    public $comment;

    /**
     * CommentsController constructor.
     * @param $answer
     * @param $question
     * @param $comment
     */
    public function __construct(AnswersRepository $answer, QuestionRepository $question, CommentRepository $comment) {
        $this->answer   = $answer;
        $this->question = $question;
        $this->comment  = $comment;
    }

    public function answer($id) {
        return $this->answer->getAnswerComments($id);
    }
    public function question($id) {
        return $this->question->getQuestionComment($id);
    }

    public function store() {
        $model = $this->getModelNameFromType(request('type'));
        return $this->comment->create([
            'user_id'          =>  user('api')->id,
            'commentable_id'   => request('model'),
            'commentable_type' => $model,
            'body'             => request('body'),

        ]);

    }

    private function getModelNameFromType($request) {
       return $request === 'question' ? 'App\Question' : 'App\Answer';
    }
}
