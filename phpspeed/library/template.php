<?php namespace Library;

class template {
    public static function view( $_template_name, $view = ''){
        extract($view);
        include TEMPLATE_PATH.$_template_name.TEMPLATE_SUFFIX;
    }
}