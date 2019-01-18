<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 11:00
 */

namespace App;


class Setting {
    protected $user;
    protected $allowed=[
        'city',
        'bio',
    ];
    /**
     * Setting constructor.
     * @param $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function merge(array $attritube) {
        $setting = array_merge($this->user->settings, array_only($attritube, $this->allowed));
        return $this->user->update([
            'settings' => $setting,
        ]);
    }
}