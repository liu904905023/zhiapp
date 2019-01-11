<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 9:08
 */

namespace App\Mailer;


use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer {
    protected function sendTo($bind_data,$template_id,$email) {


        $template = new SendCloudTemplate($template_id, $bind_data);

        Mail::raw($template, function ($message) use($email){
            $message->from('904905023@qq.com', 'Laravel');

            $message->to($email);
        });
    }
}