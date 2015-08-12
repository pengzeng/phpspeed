<?php
/*
|----------------------------------------------------------
| phpspeed 公共函数库
|----------------------------------------------------------
*/

/*
+----------------------
+读取配置文件的方法
*/
function config( $name ){
    if( ! is_string($name) ) return $name;
    return require CONFIG_PATH.$name.FILES_SUFFIX;
}