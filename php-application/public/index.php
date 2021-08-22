<?php
use Core\Router;

/**
 * Front Controller
 *
 * PHP version 7.4
 */

/**
 * Include Twig
 */
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

/**
 * Class autoloading
 */
/*
spl_autoload_register( function ( $class ) {
$root = dirname( __DIR__ ); // Get the parent directory
$classFile = $root . '/' . str_replace( '\\', '/', $class ) . '.php';

if ( is_readable( $classFile ) ) {
require $root . '/' . str_replace( '\\', '/', $class ) . '.php';
}

} );
 */

/**
 * Error and exception handling
 *
 */
error_reporting( E_ALL );
set_error_handler( 'Core\Error::errorhandler' );
set_exception_handler( 'Core\Error::exceptionHandler' );

$router = new Core\Router();

// Add the routes
$router->add( '', ['controller' => 'Home', 'action' => 'index'] );
$router->add( '{controller}' );
$router->add( '{controller}/{action}' );
$router->add( '{controller}/{id:\d+}/{action}' );
$router->add( 'admin/{controller}/{action}', ['namespace' => 'Admin'] );

// Match the requested route
$url = trim( $_SERVER['REQUEST_URI'], '/' );
$router->dispatch( $url );