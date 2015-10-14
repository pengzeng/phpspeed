<?php namespace library;

class template {
    public static function view( $view = '', $_template_ = false){
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
        include self::runtime( $_template_ );
    }

    public static function runtime( $path ){
        if( ! is_file(TEMPLATE_PATH.$path)) {
            exception::outerror(404, [
                'message' => 'template not found',
                'file'    => $path,
                'line'    => 0
            ]);
        }

        $fname = self::cache_file_name($path);

        if(file_exists($fname)){
            APP_DEBUG && self::replace($fname, TEMPLATE_PATH.$path);
        } else self::replace($fname, TEMPLATE_PATH.$path);
        return $fname;
    }
    public static function cache_file_name($path){
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
        return $dir.'/'.md5($path).CACHE_SUFFIX;
    }
    public static function replace($fname, $path){
        $txt  = file_get_contents($path);
        if(empty($txt) ){
            file_put_contents($fname ,$txt);return;
        }
        // template regular
        $pattern = [
            '/<\{(.*)\}>/Us',          # output
            '/{@(.*)}/Us',             # define variable
            '/{:(.*)}/Us',             # use function
            '/@end/Us',                # if for foreach ... end
            '/@foreach\((.*)\)/Us',    # foreach start
            '/@if\((.*)\)/Us',         # if start
            '/@elseif\((.*)\)/Us',     # elseif start
            '/@else/Us',               # else
            '/@switch\((.*)\)/Us',     # switch start
            '/@case(.*):/Us',          # switch case
            '/@default(.*):/Us',       # switch start
            '/@break/Us',              # switch start
            '/@for\((.*)\)/Us',        # for start
        ];
        // replace str
        $replace = [
            '<?php echo \\1;?>',
            '<?php $\\1;?>',
            '<?php \\1;?>',
            '<?php }?>',
            '<?php foreach(\\1){?>',
            '<?php if(\\1){?>',
            '<?php }elseif(\\1){?>',
            '<?php }else{?>',
            '<?php switch(\\1){?>',
            '<?php case \\1 :?>',
            '<?php default \\1 :?>',
            '<?php break;?>',
            '<?php for(\\1){?>',
        ];
        // recursive of son template
        $inc_pattern = '/@include\([\'|"](.*)[\'|"]\)/Us';
        preg_match_all($inc_pattern, $txt, $inc);
        $inc_replace = [];
        foreach ($inc[1] as $k => $v) {
            $inc_replace[] = '<?php include "'.
                self::runtime( '/'.$v.TEMPLATE_SUFFIX ).
                '";?>';
        }
        // replace and write cache
        if(!(empty($inc[0])))
            $txt = str_replace($inc[0], $inc_replace, $txt);
        $txt = preg_replace($pattern, $replace, $txt);
        file_put_contents($fname ,$txt);
    }
}