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

    static $_conf;


    public static function init(){
        self::$_conf = require PATH.'/config/phpspeed.php';
        // register autoload function
        spl_autoload_register( 'Library\kernel::autoload' );
        // register error function
        register_shutdown_function('Library\kernel::fatalError');
        set_error_handler('Library\kernel::appError');
        set_exception_handler('Library\kernel::appException');
        $route = require PATH.'/route'.FILES_SUFFIX;
        $pathinfo = substr($_SERVER['PATH_INFO'], 1);

        if( empty($pathinfo) || $pathinfo == '/' ) return template::view('index');
        $pathinfo_key = false;
        foreach ($route as $k => $v) {
            if( preg_match('/^'.str_replace( '/', '\/', $k ).'/', $pathinfo) ){
                $pathinfo_key = $k;break;
            };
        }

        if(!$pathinfo_key) return template::view('error');

        $route_value = $route[$pathinfo_key];
        switch( gettype( $route_value ) ){
            case 'string' : break;
            case 'object' :

                $object = $route_value();
                switch( gettype( $object ) ){
                    case 'string' :
                        template::view( $object); break;
                    case 'array'  :
                        template::view( $object[0], $object[1]); break;
                    default :
                        echo 'route error';
                }
                break;
            case 'array'  :
                echo $route[$pathinfo]; break;
            default :
                echo 'route error';
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


}

require PATH.'/function/func.php';