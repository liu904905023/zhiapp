<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public $user;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function index(Request $request) {
        $user = $this->user->byId($request->get('user'));

        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if(in_array(\Auth::guard('api')->user()->id,$followers)) {
            return response()->json([
                'followed' => true,
            ]);
        }
        return response()->json([
            'followed' => false,
        ]);
    }

    public function follow(Request $request) {
        $userToFollow = $this->user->byId($request->get('user'));
        $followed = \Auth::guard('api')->user()->followThisUser($userToFollow->id);
        if(count($followed['attached'])>0){
//            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->decrement('followers_count');

            return response()->json([
                'followed' => false,
            ]);
        }
        $userToFollow->increment('followers_count');
        return response()->json([
            'followed' => true,
        ]);
    }
}
