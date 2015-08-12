<?php namespace Library;

class template {
    public static function view( $_template_ = false, $view = ''){
        extract($view);
        if($_template_){
            $_template_ = '/'.$_template_.TEMPLATE_SUFFIX;
        }else{
            $_template_ = '';
            (defined('GROUP_NAME')) && $_template_.='/'.GROUP_NAME;
            (defined('CONTROLLER_NAME')) && $_template_.='/'.CONTROLLER_NAME;
            (defined('ACTION_NAME')) && $_template_.='/'.ACTION_NAME;
            $_template_.=TEMPLATE_SUFFIX;
        }
        if(is_file(TEMPLATE_PATH.$_template_))
            require self::runtime( $_template_ );
        else {
            exception::outerror(404, [
                'message' => 'template not found',
                'file'    => $_template_,
                'line'    => 0
            ]);
        }
    }

    public static function runtime( $path ){
        $temp = explode('/', $path);
        unset($temp[count($temp)-1],$temp[0]);
        $dir = RUNTIME_PATH;
        foreach ($temp as $v) {
            $dir.='/'.$v;
        }
        ! file_exists($dir) &&
        ! mkdir($dir, 0755, true) &&
        exception::outerror(404, [
            'message' => 'runtime directory is not available',
            'file'    => $dir,
            'line'    => 0
        ]);
        $fname = $dir.'/'.md5($path).CACHE_SUFFIX;

        if(file_exists($fname)){
            APP_DEBUG && self::replace($fname, TEMPLATE_PATH.$path);
        } else self::replace($fname, TEMPLATE_PATH.$path);
        return $fname;
    }

    public static function replace($fname, $path){
        $txt  = file_get_contents($path);
        if( ! empty($txt) ){

        }
        file_put_contents($fname ,$txt);
    }
}