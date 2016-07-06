## phpspeed framework stable version 1.0

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
    '/home/index/.*' => ['url','home/index'],

    // 静态html
    '/' => ['html','index'],

    // 模板路由(直接返回模板) [路由类型,模板名称,输出数据]
    '/tpl' => ['tpl','html',['welcome' => 'welcome phpspeed !']],

    // 接口路由 [路由类型,分组名/控制器｜控制器,['GET','POST','DELETE','SELECT']]
    // 'product' => ['api','product',[]], // 请求类型数组为空代表任意
    '/product' => ['api','product',['GET','POST','DELETE','SAVE']],

    // 嘿嘿
    '/test' => ['url','test'],

];
```
## 模板处理

### 控制器 use library\template;

```php
template::view(array 输出到模板的数组 [,string 指定模板文件] );
```

### 加载子模板
```php
@include('public/header')
@include("public/footer")
```

### foreach 结构
```php
@foreach($data as $k => $v)
<p>{{$v}}</p>
@end
```

### if 结构
```php
@if(1)
<p>9527</p>
@elseif(1)
<p>9527</p>
@end
```

### switch 结构
```php
@switch($v['status'])
    @case('1','aaa')
    @case('2','ccc')
@switchend
```

### for 结构
```php
@for($i=0;$i<10;$i++)
<p>{{$i}}</p>
@end
```

### 定义变量
```php
{@aa='1'}
{@aa=['45','321','13']}
```


### 输出
```php
<p>{{$aa}}</p>
{{date('Y-m-d',time())}}
{{$check ? 'true' : 'false'}}
```

## 操作数据库 链式操作

### 控制器  use library\db;

```php


db::table('table_name')->where(array()|string)->order(string)->field(string, [ bool 反选 ])->limit(string)->select();

db::table('table_name')->where(array()|string)->first();

db::table('table_name')->join(' a LEFT JOIN table_name2 b ON a.id=b.id')->select();

_query string 原始sql查询(返回PDO对象)
_connect 返回PDO链接对象

where array|string 查询条件
group string 分组字段名
having string 分组查询条件
insert array 增加记录
delete 删除记录返回结果
save array 更新记录
order string 排序条件
join string 连接查询字符串
field string 字段筛选,[bool true反选]
limit string 记录数
select 返回值 array 返回多条记录
first 返回值 array 返回单条记录
value string 字段名 (返回值 string 参数)
count  返回值 int (统计记录数)
sum string 字段名(返回求和结果)
inc string 字段名,[int 增加整数] (字段增加)
dec string 字段名,[int 减少整数] (字段减少)

```