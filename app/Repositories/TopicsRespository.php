<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 14:26
 */

namespace App\Repositories;

use App\Topic;
use Request;

class TopicsRespository {

    public function getTopicsByTagging(Request $request) {
//        DB::select("select * from topics where locate ('".$request->query('q')."',name)");
        return Topic::select('id', 'name')->where('name', 'like','%'. $request->query('q').'%')->get();
    }
}