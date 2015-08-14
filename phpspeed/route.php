<?php
/*
| phpspeed route config
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| wwww    : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/
return [

    // 直接返回模板
    '/' => function(){return 'index';},
    '/home/user/info' => function(){
        return [
            'info',['username' => 'bruce']
        ];
    },

    // 基本路由配置
    '/home/user/.*'    => 'home/user',
    '/home/item/.*'    => 'home/item',
    '/home/list/index' => 'home/list/index',
    '/test'            => 'test',    // 解析到 controller 下test文件
];