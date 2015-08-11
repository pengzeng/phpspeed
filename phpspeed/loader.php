<?php

/*
| phpspeed loader file
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| wwww    : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/



// dir
define( 'PHP_SPEED', __DIR__ );
// phpspeed path
define( 'APP_PATH', PHP_SPEED );
// start debug
define( 'APP_DEBUG', true );

// phpspeed version
const PHPSPEED_VERSION = '1.0.0';

// controller path
define( 'CONTROLLER_PATH', APP_PATH.'/Controller' );
// controller namespace name
define( 'CONTROLLER_NAMESPACE', 'Controller' );
// template files path
define( 'TEMPLATE_PATH', APP_PATH.'/template' );
// template files suffix
define( 'TEMPLATE_SUFFIX', '.php' );
// files suffix
define( 'FILES_SUFFIX', '.php' );



// include kernel
require APP_PATH.'/library/kernel'.FILES_SUFFIX;
// start phpspeed
Library\kernel::init();
