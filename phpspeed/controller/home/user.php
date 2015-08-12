<?php namespace Controller\Home;

use Extend\wechat;

class user {
    public function __construct(){
//        var_dump(config('mysql'));
    }
    public function index(){
        $wecaht = new wechat();
        $wecaht->test();
    }
}