<?php

    header('Content-Type: application/json');

    require_once __DIR__ . '/vendor/autoload.php';

    use App\Routing\Router;
    use App\Controllers\OrderController;
    
    $router = new Router();
    $router->post('/api/order/calculate', [OrderController::class, 'calculateOrder']);

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $router->dispatch($method, $uri);
?>