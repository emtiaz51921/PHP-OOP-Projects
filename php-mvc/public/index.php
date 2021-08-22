<?php
/**
 * Default index.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( dirname( __DIR__ ) );
$dotenv->load();

use \app\core\Application;
use \app\controllers\SiteController;
use \app\controllers\AuthController;

$config = [
    'userClass' => \app\models\User::class,
    'db'        => [
        'dns'      => $_ENV['DB_DNS'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application( dirname( __DIR__ ), $config );

$app->router->get( '/', [SiteController::class, 'home'] );

$app->router->get( '/contact', [SiteController::class, 'contact'] );

$app->router->post( '/contact', [SiteController::class, 'contact'] );

$app->router->get( '/login', [AuthController::class, 'login'] );
$app->router->post( '/login', [AuthController::class, 'login'] );

$app->router->get( '/register', [AuthController::class, 'register'] );
$app->router->post( '/register', [AuthController::class, 'register'] );

$app->router->get( '/logout', [AuthController::class, 'logout'] );
$app->router->post( '/logout', [AuthController::class, 'logout'] );

$app->router->get( '/profile', [AuthController::class, 'profile'] );

$app->run();