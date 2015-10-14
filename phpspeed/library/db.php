<?php namespace library;
use library\database\mysql;

class db{

    public static function table( $tname = ''){
        return new mysql( $tname );
    }
}