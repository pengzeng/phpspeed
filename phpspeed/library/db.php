<?php namespace library;

use library\database\mysql;
use library\database\redis;


class db{

    public static function table( $tname = '', $db = 'mysql'){
        return new mysql( $tname , $db);
    }

    public static function redis( $db = '' ){
        return redis::_connect();
    }
}