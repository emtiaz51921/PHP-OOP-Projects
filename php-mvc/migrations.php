<?php
/**
 * Default migrations.php
 */

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

use \app\core\Application;
use \app\controllers\SiteController;
use \app\controllers\AuthController;

$config = [
    'db' => [
        'dns'      => $_ENV['DB_DNS'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application( __DIR__, $config );

$app->db->applyMigrations();