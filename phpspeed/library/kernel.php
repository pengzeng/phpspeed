<?php namespace Library;

/*
| phpspeed kernel class
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| wwww    : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/

class kernel {

    public static function init(){
        // register autoload function
        spl_autoload_register( 'Library\kernel::autoload' );
        // register error function
        register_shutdown_function('Library\kernel::fatalError');
        set_error_handler('Library\kernel::appError');
        set_exception_handler('Library\kernel::appException');
        $route = require PATH.'/route.php';
        $pathinfo = substr($_SERVER['PATH_INFO'], 1);
        if(empty($pathinfo)) $pathinfo = '/';
        $pathinfo_key = false;
        foreach ($route as $k => $v) {
            if( preg_match('/^'.str_replace( '/', '\/', $k ).'/', $pathinfo) ){
                $pathinfo_key = $k;break;
            };
        }

        $route_value = $route[$pathinfo_key];
        if(empty($route_value)) self::outerror(404);
        switch( gettype( $route_value ) ){
            case 'string' :
                template::view( $route_value );
                break;
            case 'object' :
                $object = $route_value();
                switch( gettype( $object ) ){
                    case 'string' :
                        template::view( $object );
                        break;
                    case 'array'  :
                        template::view( $object[0], $object[1] ); break;
                    default :
                        self::outerror(404);
                }
                break;
            case 'array'  :
                self::template(); break;
            default :
                self::outerror(404);
        }

    }

    public static function autoload($class){
        include PATH.'/'.$class.FILES_SUFFIX;
    }

    public static function fatalError(){

    }

    public static function appError(){

    }

    public static function appException(){

    }

    private static function template(){

    }

    private static function outerror( $code, $message = false){
        if($message) json_encode($message);
        switch($code){
            case 404 : header('HTTP/1.0 404 Not Found'); break;
        }

    }

}

require PATH.'/function/func.php';