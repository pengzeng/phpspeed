<?php namespace Controller\Home;

<<<<<<< HEAD
use Extend\wechat;
=======
use Library\database\mysql,
    Library\database\redis,
    Library\template;
>>>>>>> 7f0812b6ce08e161890688810a63c414accb27f7

class user {
    use mysql,redis {
        _mysql_connection   as _mysql;
        _redis_connection   as _redis;
    }
    public function __construct(){

    }
    public function index(){
        /*$list = $this->_mysql()->query("show tables");
        foreach ($list as $v) {
            echo '<pre>';
            var_dump($v);
        }
        var_dump($this->_redis()->set('test', microtime(), 300));
        var_dump($this->_redis()->get('test'));*/
        template::view('', microtime() );
    }
}