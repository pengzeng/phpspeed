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
//    '/home/user/.*' => function(){return ['home/user','sdfsdf234234234'];},
    '/home/user/.*' => 'home/user',
    '/home/index/.*' => 'home/index',
//    '/home/user/index' => [],
    '/' => function(){return 'index';},
];