<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 14:40
 */
if (!function_exists('user')) {
    function user($driver=null) {
        if ($driver) {
            return app('auth')->guard($driver)->user();
        }
        return app('auth')->user();
    }
}