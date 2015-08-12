<?php namespace Library\database;

use Redis as _Redis,
    RedisException;

trait redis {
    private static $_redis  = null;
    private static $_prefix = '';
    private function _redis_connection(){
        if( ! self::$_redis instanceof _Redis){
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
                self::$_redis = $instance;
            }catch ( RedisException $e){
                \Library\template::view(ERROR_DEBUG, [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine()
                ]);
            }
        }
        return self::$_redis;
    }
}