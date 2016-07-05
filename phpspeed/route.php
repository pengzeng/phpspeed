<?php
/*
| phpspeed route config
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| www     : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/

return [

    // 默认路由 [路由类型,分组名/控制器｜控制器]
    '/home/index/.*' => ['url','home/index'],

    // 静态html
    '/' => ['html','index'],

    // 模板路由(直接返回模板) [路由类型,模板名称,输出数据]
    '/tpl' => ['tpl','html',['welcome' => 'welcome phpspeed !']],

    // 接口路由 [路由类型,分组名/控制器｜控制器,['GET','POST','DELETE','SELECT']]
    // 'product' => ['api','product',[]], // 请求类型数组为空代表任意
    '/product' => ['api','product',['GET']],

    // 嘿嘿
    '/test' => ['url','test'],

];