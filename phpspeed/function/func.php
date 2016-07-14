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
    return include CONFIG_PATH.$name.FILES_SUFFIX;
}

// 写日志方法
function write_logs($log, $path = false){
    if(!is_dir(LOGS_PATH)) mkdir(LOGS_PATH, 0755, true);
    $log = "\n".date('Y-m-d H:i:s').': '.$log;
    $path = $path ? $path : LOGS_PATH.'/'.date('YmdH').'.log';
    $f = fopen($path, "a+");
    if(!fwrite($f, $log, 2097152)){
        fclose($f);
        $path = $path ? $path : LOGS_PATH.'/'.date('YmdHi').'.log';
        $f = fopen($path, "a+");
        fwrite($f, $log, 2097152);
    };
    fclose($f);
}

/**
 * 判断是否是微信浏览器
 */
function is_wechart(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * 获取ip地址
 * @return [type] [description]
 */
function getip()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

/*
 * 检测手机号是否正确
 * */
function ismobile( $mobile ){
    return preg_match("/^1[345678]{1}[0-9]{9}$/", $mobile);
}


function Pinyin($_String, $_Code='UTF8'){ //GBK页面可改为gb2312，其他随意填写为UTF8
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
        "|-10270|-10262|-10260|-10256|-10254";
    $_TDataKey   = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data = array_combine($_TDataKey, $_TDataValue);
    arsort($_Data);
    reset($_Data);
    if($_Code!= 'gbk') $_String = _U2_Utf8_Gb($_String);
    $_Res = '';
    for($i=0; $i<strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if($_P>160) {
            $_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536;
        }
        $_Res .= _Pinyin($_P, $_Data);
    }
    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}
function _Pinyin($_Num, $_Data){
    if($_Num>0 && $_Num<160 ){
        return chr($_Num);
    }elseif($_Num<-20319 || $_Num>-10247){
        return '';
    }else{
        foreach($_Data as $k=>$v){ if($v<=$_Num) break; }
        return $k;
    }
}


/**
 * 打印
 */
function dump( $arr ){
    echo '<pre>';
    var_dump($arr);
}

/**
 *  @brief 生成随机字串
 *
 *  @param [in] $length 需要生成的字串长度
 *  @return str 生成的随机字串
 */
function mt_rand_str ($length, $from = 'abcdefghijklmnopqrstuvwxyz1234567890abcdefghijklmnopqrstuvwxyz1234567890') {
    for ($str = '', $len = strlen($from)-1, $i = 0; $i < $length; $str .= $from[mt_rand(0, $len)], ++$i);
    return $str;
}

// 判断请求
function is_request( $request ){
    return $request == $_SERVER['REQUEST_METHOD'];
}


function url( $path , $domain = false){
    return $domain ?
        'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'/'.$path :
        $_SERVER['SCRIPT_NAME'].'/'.$path;
}

function tourl( $url, $domain = false){
    header("Location: ".( $domain ? $url : url($url, true)));
}


/**
 * 当天当前秒数
 * @param
 * @return
 */
function dayseconds(){
    $S = time()-strtotime(date('Y-m-d'));
    $len = 5 - strlen($S);
    for($i=0;$i<$len;$i++){
        $S='0'.$S;
    }
    return $S;
}

/**
 * 返回当前毫秒
 */
function nowminsecond(){
    $s = explode(' ',microtime());
    $r = floor(floatval($s[0])*100000);
    $len = 5 - strlen($r);
    for($i=0;$i<$len;$i++){
        $r='0'.$r;
    }
    return $r;
}

/*--------返回订单编号--------*/
function order_no(){
    return date('Ymd').dayseconds().mt_rand(10000,99999);
}

/*--------返回订单编号--------*/
function order_no2(){
    return date('ymd').dayseconds().nowminsecond().mt_rand(10,99);
}

/*-------- 成功返回JSON --------*/
function success( $info, $data = [], $url = ''){
    header("Content-type: application/json");
    exit(json_encode(array(
        'code' => '1',
        'info' => $info,
        'data' => $data,
        'url'  => $url
    )));
}

/*-------- 失败返回JSON --------*/
function notice($info, $url = ''){
    header("Content-type: application/json");
    exit(json_encode(array(
        'code' => '0',
        'info' => $info,
        'url'  => $url
    )));
}

function outjson($data = [],$code = '1',  $info = ''){
    header("Content-type: application/json");
    exit(json_encode(array(
        'code' => $code,
        'data' => $data,
        'info' => $info
    )));
}

function outarray($data = []){
    header("Content-type: application/json");
    exit(json_encode($data));
}


// 存取消session数据
function session( $key = '', $data = false, $expire = 3600){
    if($key === null || $key === NULL) return session_destroy();
    $sess = null;
    if(empty($key)){
        $sess = $_SESSION;
        foreach($sess as &$v){
            $v = is_null(json_decode($v, true)) ? $v : json_decode($v, true);
        }
    }else{
        if($data === false){
            if(isset($_SESSION[$key]))
                $sess = is_null(json_decode($_SESSION[$key], true)) ?
                    $_SESSION[$key] : json_decode($_SESSION[$key], true);
        }elseif($data === null || $data === NULL){
            unset($_SESSION[$key]);
        }else{
            $data = (gettype($data) == 'array' || gettype($data) == 'object') ?
                json_encode($data) : $data;
            $_SESSION[$key] = $data;
        }
    }
    return $sess;
}


// 存取消cookie数据
function cookie($key = '', $data = false, $expire = 7200){
    $sess = null;
    if(empty($key)){
        $sess = $_COOKIE;
        foreach($sess as &$v){
            $v = is_null(json_decode($v, true)) ? $v : json_decode($v, true);
        }
    }else{
        if($data === false){
            if(isset($_COOKIE[$key]))
            $sess = is_null(json_decode($_COOKIE[$key], true)) ?
                $_COOKIE[$key] : json_decode($_COOKIE[$key], true);

        }elseif($data === null || $data === NULL){
            $sess = setcookie($key, '', NOW_TIME - 3600);
        }else{
            $data = (gettype($data) == 'array' || gettype($data) == 'object') ?
                json_encode($data) : $data;
            $sess = setcookie($key, $data, NOW_TIME + $expire);
        }
    }
    return $sess;
}


// 获取POST GET 数据
function fetch($name,$default='',$filter=null,$datas=null) {
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :   $input =& $_GET;break;
        case 'post'    :   $input =& $_POST;break;
        case 'put'     :   parse_str(file_get_contents('php://input'), $input);break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                    parse_str(file_get_contents('php://input'), $input);
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'path'    :
            $input  =   array();
            if(!empty($_SERVER['PATH_INFO'])){
                $depr   =   '/';
                $input  =   explode($depr,trim($_SERVER['PATH_INFO'],$depr));
            }
            break;
        case 'request' :   $input =& $_REQUEST;   break;
        case 'session' :   $input =& $_SESSION;   break;
        case 'cookie'  :   $input =& $_COOKIE;    break;
        case 'server'  :   $input =& $_SERVER;    break;
        case 'globals' :   $input =& $GLOBALS;    break;
        case 'data'    :   $input =& $datas;      break;
        default:
            return NULL;
    }
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:'htmlspecialchars';
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }
    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        is_array($data) && array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:'htmlspecialchars';
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }

            foreach($filters as $filter){
                if(function_exists($filter)) {
                    $data   =   is_array($data)?array_map_recursive($filter,$data):$filter($data); // 参数过滤
                }else{
                    $data   =   filter_var($data,is_int($filter)?$filter:filter_id($filter));
                    if(false === $data) {
                        return   isset($default)?$default:NULL;
                    }
                }
            }
        }
    }else{ // 变量默认值
        $data       =    isset($default)?$default:NULL;
    }
    return $data;
}



function array_map_recursive($filter, $data) {
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
    }
    return $result;
}

// 过滤表单中的表达式
function filter_exp(&$value){
    if (in_array(strtolower($value),array('exp','or'))){
        $value .= ' ';
    }
}