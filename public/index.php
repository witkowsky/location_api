<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/bootstrap.php';

use App\Controller\Location\CreateController;
use App\Controller\Location\FilterController;
use App\Controller\Location\FindByIdController;
use App\Controller\Location\RemoveController;
use App\Controller\Location\UpdateController;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;
use function FastRoute\simpleDispatcher;

//Routes
$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->get('/location', FilterController::class);
    $r->post('/location', CreateController::class);
    $r->post('/location/{id}', UpdateController::class);
    $r->get('/location/{id}', FindByIdController::class);
    $r->delete('/location/{id}', RemoveController::class);
});
$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($containerBuilder);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());
$emitter = new SapiEmitter();
$emitter->emit($response);
