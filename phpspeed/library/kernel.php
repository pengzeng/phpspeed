<?php namespace library;

/*
| phpspeed kernel class
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| www     : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/
use Exception;

class kernel {
    private static $route_map = [];
    public static function init(){

        // 设置header
        header("Server: yzs");
        header("X-Powered-By: yzs");
        header("Content-type: text/html; charset=utf-8");

        // 禁用所有错误信息
        error_reporting(0);

        // 启用session
        session_start();

        // 注册自动加载函数
        spl_autoload_register( 'Library\kernel::autoload' );

        // 注册系统错误捕获函数
        register_shutdown_function('Library\appexception::system_error');

        // 注册用户自定义错误捕获函数
        set_error_handler('Library\appexception::app_error');

        // 注册用户抛出的异常错误捕获函数
        set_exception_handler('Library\appexception::app_exception');

        // 加载路由配置
        $route = include(APP_PATH.'/route'.FILES_SUFFIX);

        // 读取PATHINFO
        $pathinfo = PATH_INFO;
        if(empty($pathinfo)) $pathinfo = '/';

        // 索引路由成功直接处理
        if($route[$pathinfo]){
            static::route_resolve( $route[$pathinfo] ); return;
        }

        // 搜索路由
        $pathinfo_key = false;
        foreach ($route as $k => $v) {
            if( ! ($k == '/') )
                if( preg_match('/^'.str_replace( '/', '\/', $k ).'$/', $pathinfo) ){
                    $pathinfo_key = $k;break;
                };
        }

        // 路由未定义
        if(empty($pathinfo_key)) throw new Exception('route not found');

        // 路由处理
        $temp = explode( '/', $pathinfo );
        self::$route_map = ['action' => $temp[( count($temp) - 1 )]];
        static::route_resolve($route[$pathinfo_key]);

    }

    // 自动加载文件
    public static function autoload($class){
        include(APP_PATH.'/'.str_replace('\\','/',$class).FILES_SUFFIX);
    }

    // 路由处理
    public static function route_resolve( $value ){
        switch( $value[0] ){

            // route interface
            case 'interface' :
                self::$route_map['controller'] = $value[1];
                self::$route_map['action'] = strtolower($_SERVER['REQUEST_METHOD']);
                self::interface_route();
                exit;

            // route template
            case 'template' :
                template::view($value[2], $value[1]);
                exit;

            // route static
            case 'static' :
                include(TEMPLATE_PATH.'/'.$value[1].TEMPLATE_SUFFIX);
                exit;

            // route default
            case 'default'  :
                $temp = explode( '/', $value[1] );
                $count = count($temp);
                if( isset(static::$route_map['action']) ){
                    self::$route_map['controller'] = $temp[$count-1];
                    ($count > 1) && self::$route_map['group'] = $temp[$count-2];
                }else{
                    self::$route_map['action'] = $temp[$count-1];
                    ($count > 1) && self::$route_map['controller'] = $temp[$count-2];
                    ($count > 2) && self::$route_map['group'] = $temp[$count-3];
                }
                break;

            // route error
            default :
                throw new Exception('route error');

        }
        !empty(self::$route_map['group']) && define( 'GROUP_NAME' ,self::$route_map['group']);
        !empty(self::$route_map['controller']) && define( 'CONTROLLER_NAME' ,self::$route_map['controller']);
        !empty(self::$route_map['action']) && define( 'ACTION_NAME' ,self::$route_map['action']);
        self::default_route();
    }

    // 默认路由实例化
    private static function default_route(){
        global $_extract;
        // set define

        if(!defined('CONTROLLER_NAME')){
            return include(CONTROLLER_PATH.'/'.ACTION_NAME.FILES_SUFFIX);
        }
        $_namespace = '\\'.CONTROLLER_NAMESPACE;
        if(defined('GROUP_NAME')) $_namespace.='\\'.GROUP_NAME.'\\'.CONTROLLER_NAME;
        else $_namespace.='\\'.CONTROLLER_NAME;
        $objects = new $_namespace;
        if(is_array($objects->extract) && !empty($objects->extract))
            $_extract = $objects->extract;
        $action  = ACTION_NAME;
        $objects->$action();
        return true;
    }

    // 接口路由实例化
    private static function interface_route(){
        $_namespace = '\\'.CONTROLLER_NAMESPACE.'\\'.str_replace('/', '\\', self::$route_map['controller']);
        $objects = new $_namespace;
        $action  = self::$route_map['action'];
        $objects->$action();
        return true;
    }

}

include(APP_PATH.'/function/func.php');