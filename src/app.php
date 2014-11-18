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
use Silex\Provider\TranslationServiceProvider;

$app = new Application();

// URL Generator Service
$app->register(new UrlGeneratorServiceProvider());

// Session Service
$app->register(new SessionServiceProvider());

// TWIG Service
$app->register(new TwigServiceProvider(), array(
    // descomenta esta línea para activar la cache de Twig y añade una coma
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig')
));

// Cache HTTP activated
$app->register(new HttpCacheServiceProvider(), array(
   'http_cache.cache_dir' => __DIR__.'/../cache/http',
   'http_cache.esi'       => null,
));

// Email Service
$app->register(new SwiftmailerServiceProvider());

// Translation Service
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale' => 'es',
    'locale_fallbacks' => array('en'),
));

return $app;