<?php

set_exception_handler('app_exception');
register_shutdown_function('system_error');
//set_error_handler('app_error');


function system_error(){
    if($err = error_get_last())
        echo(
            "error : {$err['message']}<br />".
            "file : {$err['file']}<br />".
            "line : {$err['line']}"
        );
}

function app_error($errno, $errstr, $errfile, $errline){
    echo(
        "Custom error : [$errno] $errstr<br />".
        "Error on line : $errline in $errfile<br />".
        "Ending Script"
    );
}

function app_exception(Exception $e){
    echo '<pre>';
    print_r($e);
}

//phpinf();

//if(!isset($_GET['test']))
//    trigger_error('123456789', E_USER_ERROR);

print_r($aaa);

if(!isset($_GET['test']))
    throw new Exception('test keys empty');


echo '12345789';