<?php

/*
| phpspeed loader file
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| wwww    : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/



// define phpspeed
define( 'PHP_SPEED', __DIR__ );
define( 'PATH', PHP_SPEED );
define( 'PHPSPEED_VERSION', '1.0' );

// define file path
define( 'CONTROLLER_NAMESPACE', 'Controller' );
define( 'TEMPLATE_PATH', PATH.'/template/' );
define( 'TEMPLATE_SUFFIX', '.php' );
define( 'FILES_SUFFIX', '.php' );




require PATH.'/library/kernel.php';

Library\kernel::init();
