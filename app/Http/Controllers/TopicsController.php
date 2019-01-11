<?php

namespace App\Http\Controllers;

use App\Repositories\TopicsRespository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public $topic;

    /**
     * TopicsController constructor.
     * @param $topic
     */
    public function __construct(TopicsRespository $topic) {
        $this->topic = $topic;
    }

    public function index(Request $request) {
//        $topic = \App\Topic::select('id', 'name')->where('name', 'like','%'. $request->query('q').'%')->get();
//    $topic = DB::select("select * from topics where locate ('".$request->query('q')."',name)");

        return $this->topic->getTopicsByTagging($request);

    }
}
