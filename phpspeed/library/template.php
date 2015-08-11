<?php namespace Library;

class template {
    public static function view( $view = '', $_template_ = false){
        extract($view);
        if($_template_){
            $_template_ = TEMPLATE_PATH.'/'.$_template_.TEMPLATE_SUFFIX;
        }else{
            $_template_ = TEMPLATE_PATH;
            (defined('GROUP_NAME')) && $_template_.='/'.GROUP_NAME;
            (defined('CONTROLLER_NAME')) && $_template_.='/'.CONTROLLER_NAME;
            (defined('ACTION_NAME')) && $_template_.='/'.ACTION_NAME;
            $_template_.=TEMPLATE_SUFFIX;
        }
        if(is_file($_template_)) return require $_template_;
        else {
            header('HTTP/1.0 404 Not Found');
            APP_DEBUG && extract([
                'message' => 'template not found',
                'file'    => $_template_,
                'line'    => 0
            ]);
            $error_page = TEMPLATE_PATH;
            $error_page.= APP_DEBUG ? '/error/404' : '/error/error';
            $error_page.= TEMPLATE_SUFFIX;
           return require $error_page;
        }
    }
}