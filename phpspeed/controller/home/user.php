<?php namespace Controller\Home;


use Library\template,
    Library\DB;

class user {

    public function __construct(){

    }
    public function index(){
//        var_dump($this->_redis()->set('test', microtime(), 300));
//        var_dump($this->_redis()->get('test'));
        $ret = DB::table('user_login')->where('id>9527')->limit(10)->select();
        echo '<pre>';
        var_dump($ret);
        template::view( microtime() );
    }
}