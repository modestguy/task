<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel;

$locator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($locator);
$routes = $loader->load('route.yml');

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $matcher = $matcher->match($request->getPathInfo());
    $request->attributes->add($matcher);

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Route not found!', Response::HTTP_NOT_FOUND);
}

$response->send();
