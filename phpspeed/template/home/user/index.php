

@include('public/header')

@foreach($data as $k => $v)
<p><{$v}></p>
@end

@if(1)
<p>9527</p>
@elseif(1)
<p>9527</p>
@end


@switch($aa)
@case '1' : <p>9527</p> @break
@case '2' : <p>9527</p> @break
@default  : <p>9527</p>
@end


@for($i=0;$i<10;$i++)
<p><{$i}></p>
@end


{@aa='1'}

<p><{$aa}></p>

<{date('Y-m-d',time())}>
