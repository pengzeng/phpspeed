<?php namespace Controller\Home;


use Library\template,
    Library\DB;

class user {

    public function __construct(){

    }
    public function index(){

//        $list = mysql::query("select * from ele_user")->fetchAll(\PDO::FETCH_CLASS);
//        echo "<pre>";
//        var_dump($list);
//        var_dump($this->_redis()->set('test', microtime(), 300));
//        var_dump($this->_redis()->get('test'));
        $list = DB::table('user_login')->select();
        echo '<pre>';
        var_dump($list);
        template::view( microtime() );
    }
}