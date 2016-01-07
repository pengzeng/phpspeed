<?php namespace controller\home;


use library\template,
    library\db;

class user {

    public function __construct(){

    }
    public function index(){
//        var_dump($this->_redis()->set('test', microtime(), 300));
//        var_dump($this->_redis()->get('test'));
//        $ret = db::table('sh_member')->where('uid<10')->limit(10)->select();
        echo '9527','3366';
        template::view();
    }
}