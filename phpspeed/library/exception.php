<?php namespace Library;

class exception {
    public static function outerror( $code, $message = false){
        switch($code){
            case 404 : header('HTTP/1.0 404 Not Found'); break;
        }
        if(APP_DEBUG) template::view( $message, ERROR_DEBUG );
        else template::view('', ERROR_PAGE);
        exit;
    }
}