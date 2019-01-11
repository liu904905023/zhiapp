<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 9:12
 */

namespace App\Mailer;


use App\User;

class UserMailer extends Mailer {
    public function followNotifityEmail($email) {
        $bind_data = [
            'url'  => 'http://zhiapp.dev',
            'name' => \Auth::guard('api')->user()->name,
        ];
        $template_id ='zhihu_app_follow';
        $this->sendTo($bind_data, $template_id, $email);
    }

    public function registerEmail(User $user) {
        $bind_data = [
            'url'  => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];
        $template_id ='zhihu_app_register';
        $email = $user->email;
        $this->sendTo($bind_data, $template_id, $email);
    }
}