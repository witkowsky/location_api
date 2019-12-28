<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/bootstrap.php';

use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use App\Controller\Location\FindByIdController;
use Zend\Diactoros\ServerRequestFactory;
use Relay\Relay;

//Routes
$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->get('/location/{id}', FindByIdController::class);
});
$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($containerBuilder);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());
$emitter = new SapiEmitter();
$emitter->emit($response);
