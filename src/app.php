<?php

/**
 * Agronegocios web.
 * 
 */

use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;

$app = new Application();

// Registro del generador de URLs
$app->register(new UrlGeneratorServiceProvider());

// Registro del proveedor de sesiones
$app->register(new SessionServiceProvider());

// Registro del proveedor de plantillas TWIG
$app->register(new TwigServiceProvider(), array(
    // descomenta esta línea para activar la cache de Twig y añade una coma
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig')
));

// activada la cache HTTP
$app->register(new HttpCacheServiceProvider(), array(
   'http_cache.cache_dir' => __DIR__.'/../cache/http',
   'http_cache.esi'       => null,
));

$app->register(new SwiftmailerServiceProvider());

return $app;