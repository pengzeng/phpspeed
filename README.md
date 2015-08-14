## phpspeed
phpspeed framework alpha version

## 加载子模板
```php
@include('public/header')
@include("public/header")
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

## 直接使用函数
```php
{:extract($aa)}
```

## 输出
```php
<p><{$aa}></p>
<{date('Y-m-d',time())}>
<{$check ? 'true' : 'false'}>
```
