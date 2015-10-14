<?php namespace controller\home;


use library\template,
    library\db;

class user {

    public function __construct(){

    }
    public function index(){
//        var_dump($this->_redis()->set('test', microtime(), 300));
//        var_dump($this->_redis()->get('test'));
        $ret = db::table('user_login')->where('id>9527')->limit(10)->select();
        echo '<pre>';
        var_dump($ret);
        template::view( microtime() );
    }
}