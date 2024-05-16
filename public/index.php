<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Container;
use App\Controllers\GeneratorExampleController;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Router;

require_once __DIR__. '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttributes(
    [
        HomeController::class,
        GeneratorExampleController::class
    ]
);

echo '<pre>';
print_r($router->routes());
echo '</pre>';

// $router
//     ->get('/', [HomeController::class, 'index'])
//     ->get('/invoices', [InvoiceController::class, 'index'])
//     ->get('/invoices/create', [InvoiceController::class, 'create'])
//     ->post('/invoices/create', [InvoiceController::class, 'store'])
//     ->get('/example/generator', [GeneratorExampleController::class, 'index']);

(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
