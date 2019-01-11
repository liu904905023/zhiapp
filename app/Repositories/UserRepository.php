<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 10:11
 */

namespace App\Repositories;


use App\User;

class UserRepository {
    public function byId($id) {
        return User::find($id);
    }

}