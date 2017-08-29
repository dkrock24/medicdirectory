<?php

use Symfony\Component\HttpFoundation\Request;

umask(0000);

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->headers->addCacheControlDirective('no-store, no-cache, must-revalidate', true);
$response->headers->addCacheControlDirective('post-check=0, pre-check=0', true);
$response->headers->set('Pragma:','no-cache');
$response->send();
$kernel->terminate($request, $response);
