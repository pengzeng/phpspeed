<?php namespace library;

use Exception;

class template {
    public static function view( $view = [], $_template_ = false){
        global $_extract;
        extract( array_merge($view, $_extract) );
        if($_template_){
            $_template_ = '/'.$_template_.TEMPLATE_SUFFIX;
        }else{
            $_template_ = '';
            (defined('GROUP_NAME')) && $_template_.='/'.GROUP_NAME;
            (defined('CONTROLLER_NAME')) && $_template_.='/'.CONTROLLER_NAME;
            (defined('ACTION_NAME')) && $_template_.='/'.ACTION_NAME;
            $_template_.=TEMPLATE_SUFFIX;
        }
        include(self::runtime( $_template_ ));
    }

    public static function runtime( $path ){
        if( ! is_file(TEMPLATE_PATH.$path))
            throw new Exception('template not found,'.TEMPLATE_PATH.$path);

        $fname = self::cache_file_name($path);

        self::replace($fname, TEMPLATE_PATH.$path);
        return $fname;
    }
    public static function cache_file_name($path){
        $temp = explode('/', $path);
        unset($temp[count($temp)-1],$temp[0]);
        $dir = RUNTIME_PATH;
        foreach ($temp as $v) {
            $dir.='/'.$v;
        }
        if(!file_exists($dir))
        ! file_exists($dir) &&
        ! mkdir($dir, 0755, true) && trigger_error('runtime directory is not available', E_ERROR);
        return $dir.'/'.md5($path).CACHE_SUFFIX;
    }
    public static function replace($fname, $path){
        $txt  = file_get_contents($path);
        if(empty($txt) ){
            file_put_contents($fname ,$txt);return;
        }
        // template regular
        $pattern = [
            '/\{\{(.*)\}\}/Us',          # output
            '/{@(.*)}/Us',             # define variable
            '/{:(.*)}/Us',             # use function
            '/@end/Us',                # if for foreach ... end
            '/@foreach\((.*)\)/Us',    # foreach start
            '/@if\((.*)\)/Us',         # if start
            '/@elseif\((.*)\)/Us',     # elseif start
            '/@else/Us',               # else
            '/@switch\((.*)\)/Us',     # switch start
            '/@case\((.*),(.*)\)/Us',          # switch case
            '/@default\((.*)\)/Us',       # switch start
            '/@switchend/Us',       # switch start
            '/@for\((.*)\)/Us',        # for start
            '/__SELF__/Us',            # public path
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
            '<?php switch(\\1){',
            'case \\1 : echo \\2; break;',
            'default : echo \\1 ;',
            '}?>',
            '<?php for(\\1){?>',
            $_SERVER['REQUEST_URI'],
        ];

        foreach(config('template') as $k => $v){
            $pattern[] = '/'.$k.'/Us';
            $replace[] = $v;
        }
        // recursive of son template
        $inc_pattern = '/@include\([\'|"](.*)[\'|"]\)/Us';
        preg_match_all($inc_pattern, $txt, $inc);
        $inc_replace = [];
        foreach ($inc[1] as $k => $v) {
            $inc_replace[] = '<?php include("'.
                self::runtime( '/'.$v.TEMPLATE_SUFFIX ).
                '");?>';
        }
        // replace and write cache
        if(!(empty($inc[0])))
            $txt = str_replace($inc[0], $inc_replace, $txt);
        $txt = preg_replace($pattern, $replace, $txt);
        file_put_contents($fname ,$txt);
    }
}