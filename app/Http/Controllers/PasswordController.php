<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{


    public function index() {
        return view('user.password');
    }

    public function update(UpdatePasswordRequest $request) {
        if (\Hash::check($request->get('old_password')) === user()->password) {
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('密码修改成功了，老弟！')->success();
            return back();
        }
        flash('密码修改失败了，老弟！')->success();
        return back();
    }
}
