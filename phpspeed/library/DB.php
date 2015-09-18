<?php namespace Library;
use Library\database\mysql;

class DB{

    public static function table( $tname = ''){
        return new mysql( $tname );
    }
}