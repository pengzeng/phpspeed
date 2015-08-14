
#加载子模板
@include('public/header')
@include("public/header")

#foreach 结构
@foreach($data as $k => $v)
<p><{$v}></p>
@end

#if 结构
@if(1)
<p>9527</p>
@elseif(1)
<p>9527</p>
@end

#switch 结构
@switch($aa)
@case '1' : <p>9527</p> @break
@case '2' : <p>9527</p> @break
@default  : <p>9527</p>
@end

# for 结构
@for($i=0;$i<10;$i++)
<p><{$i}></p>
@end

# 定义变量
{@aa='1'}
{@aa=['45','321','13']}

# 直接使用函数
{:extract($aa)}

# 输出
<p><{$aa}></p>
<{date('Y-m-d',time())}>
