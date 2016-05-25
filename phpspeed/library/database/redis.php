<?php namespace library\database;

use Redis as _Redis,
    RedisException;

class redis {
    static function _connect(){
        static $_redis;
        if( ! $_redis instanceof _Redis){
            $conf = config('redis') + [
                    'host'   => '127.0.0.1',
                    'port'   => '6379',
                    'auth'   => '',
                    'prefix' => ''
                ];

            try{
                $instance = new _Redis();
                $instance->connect($conf['host'], $conf['port']);
                $conf['auth'] && $instance->auth($conf['auth']);
                $_redis = $instance;
            }catch ( RedisException $e){
                \Library\exception::outerror(404, [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine()
                ]);
            }
        }
        return $_redis;
    }
}