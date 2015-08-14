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
    private static $route_map = [];
    public static function init(){

        // register autoload function
        spl_autoload_register( 'Library\kernel::autoload' );

        // register error function
        error_reporting(0);
        register_shutdown_function('Library\kernel::fatalError');
        set_error_handler('Library\kernel::appError');
        set_exception_handler('Library\kernel::appException');

        // 读取路由配置
        $route = require APP_PATH.'/route.php';

        // 读取pathinfo
        $pathinfo = substr($_SERVER['PATH_INFO'], 1);
        if(empty($pathinfo)) $pathinfo = '/';

        // 尝试直接取路由配置
        if($route[$pathinfo]){
            self::route_resolve( $route[$pathinfo] ); return;
        }

        // 尝试用正则查找路由配置
        $pathinfo_key = false;
        foreach ($route as $k => $v) {
            if( preg_match('/^'.str_replace( '/', '\/', $k ).'/', $pathinfo) ){
                $pathinfo_key = $k;break;
            };
        }

        if(empty($pathinfo_key)) exception::outerror(404, [
            'message' => 'route not found',
            'file'    => APP_PATH.'route'.FILES_SUFFIX,
            'line'    => '0'
        ]);
        $temp = explode( '/', $pathinfo );
        self::$route_map = ['action' => $temp[( count($temp) - 1 )]];
        self::route_resolve($route[$pathinfo_key]);

    }

    public static function autoload($class){
        include APP_PATH.'/'.$class.FILES_SUFFIX;
    }

    public static function fatalError(){
        $message = error_get_last();
        $message['type'] && exception::outerror(404, $message);

    }

    public static function appError($errno, $errstr, $errfile, $errline){

    }

    public static function appException(){

    }

    public static function route_resolve( $value ){
        $map = array();
        switch( gettype( $value ) ){
            // route string
            case 'string' :
                $temp  = explode( '/', $value );
                $count = count($temp);
                if( isset(self::$route_map['action']) ){
                    self::$route_map['controller'] = $temp[$count-1];
                    ($count > 1) && self::$route_map['group'] = $temp[$count-2];
                }else{
                    self::$route_map['action'] = $temp[$count-1];
                    ($count > 1) && self::$route_map['controller'] = $temp[$count-2];
                    ($count > 2) && self::$route_map['group'] = $temp[$count-3];
                }
                break;
            // route funciton
            case 'object' :
                $object = $value();
                switch( gettype( $object ) ){

                    // return template
                    case 'string' :
                        $tname = empty(self::$route_map['action']) ?
                            $object : $object.'/'.self::$route_map['action'];
                        template::view( $tname ); exit;

                    // return temlate + data
                    case 'array'  :
                        $tname = empty(self::$route_map['action']) ?
                            $object[0] : $object[0].'/'.self::$route_map['action'];
                        template::view( $tname, $object[1] );
                        exit;

                    // return error
                    default :
                        exception::outerror( 404, [
                            'message' => 'function route error',
                            'file'    => APP_PATH.'route'.FILES_SUFFIX,
                            'line'    => '0'
                        ]);
                }
                break;

            // route array
            case 'array'  :
                self::$route_map['action'] += $value;
                break;
            // route error
            default :
                exception::outerror( 404, [
                    'message' => 'route define error',
                    'file'    => APP_PATH.'route'.FILES_SUFFIX,
                    'line'    => '0'
                ]);
        }
        self::template();
    }

    private static function template(){
        // set define
        !empty(self::$route_map['group']) && define( 'GROUP_NAME' ,self::$route_map['group']);
        !empty(self::$route_map['controller']) && define( 'CONTROLLER_NAME' ,self::$route_map['controller']);
        !empty(self::$route_map['action']) && define( 'ACTION_NAME' ,self::$route_map['action']);

        if(self::$route_map['request']){
            // header request: post get put delete patch options head other ...
        } else {

            $_namespace = CONTROLLER_NAMESPACE;
            if(defined('GROUP_NAME')) $_namespace.='\\'.ucwords(GROUP_NAME).'\\'.CONTROLLER_NAME;
            else $_namespace.='\\'.CONTROLLER_NAME;
            $objects = new $_namespace;
            $action  = ACTION_NAME;
            $objects->$action();
        }
    }



}

require_once APP_PATH.'/function/func.php';