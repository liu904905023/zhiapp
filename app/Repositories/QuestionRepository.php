<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/27
 * Time: 13:32
 */

namespace App\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository {

    public function byIdWithTopics($id) {
        return Question::find($id);
    }

    public function create(array $data) {
        return Question::create($data);
    }

    public function byid($id) {
        return Question::find($id);
    }
    public function getQuestionSeed() {
        return  Question::published()->latest('created_at')->with('user')->get();
    }



    public function normalizeTopic(array $topics) {
        return collect($topics)->map(function ($topic) {
            $allTopicId = Topic::pluck('id');
            if (is_numeric($topic)&& $allTopicId->contains($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int)($topic);
            }
            $newTopic = Topic::create([
                'name'            => $topic,
                'bio'             => '',
                'questions_count' => 1,
            ]);
            return $newTopic->id;

        })->toArray();

    }
}