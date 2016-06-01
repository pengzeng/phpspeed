## phpspeed framework Alpha version 1.0

```php
    nginx rewrite: rewrite ^(.*)$ /index.php/$1 last; #pathinfo
    PHP: 5.6.x
```

## 目录结构
```php
/phpspeed/                  # 框架入口
         config/            # 配置文件
         controller/        # 控制器目录
         extend/            # 扩展目录
         function/func.php  # 函数库
         library/           # 核心目录
         module/            # 模型
         runtime/           # 编译缓存与日志目录
         template/          # 模板目录
/public/                     # 网站根目录 index.php images js css uploads

```

## 路由配置
```php
return [

    // 默认路由 [路由类型,分组名/控制器｜控制器]
    '/home/index/.*' => ['default','home/index'],

    // 静态html
    '/' => ['static','index'],

    // 模板路由(直接返回模板) [路由类型,模板名称,输出数据]
    '/tpl' => ['template','html',['welcome' => 'welcome phpspeed !']],

    // 接口路由 [路由类型,分组名/控制器｜控制器,['GET','POST','DELETE','SELECT']]
    // 'product' => ['interface','product',[]], // 请求类型数组为空代表任意
    '/product' => ['interface','product',['GET','POST','DELETE','SAVE']],

    // 嘿嘿
    '/test' => ['default','test'],

];
```

## 加载子模板
```php
@include('public/header')
@include("public/footer")
```

## foreach 结构
```php
@foreach($data as $k => $v)
<p><{$v}></p>
@end
```

## if 结构
```php
@if(1)
<p>9527</p>
@elseif(1)
<p>9527</p>
@end
```

## switch 结构
```php
@switch($aa)
@case '1' : <p>9527</p> @break
@case '2' : <p>9527</p> @break
@default  : <p>9527</p>
@end
```

## for 结构
```php
@for($i=0;$i<10;$i++)
<p><{$i}></p>
@end
```

## 定义变量
```php
{@aa='1'}
{@aa=['45','321','13']}
```


## 输出
```php
<p><{$aa}></p>
<{date('Y-m-d',time())}>
<{$check ? 'true' : 'false'}>
```
