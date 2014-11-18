<?php

use Silex\Provider\MonologServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;

// descomenta las siguientes líneas para activar la depuración
// en el entorno de producción
$app['debug'] = true;
$app->register(new MonologServiceProvider(), array(
     'monolog.logfile' => __DIR__.'/../logs/prod.log',
));

// Añadir a continuación cualquier otra opción de configuración de producción
// **********************************************************************************
 
// App title
$app['title'] = '2bi Smart IT';

// Contact email
$app['default_contact'] = 'comercial@2bi.es';

// Swiftmailer config
$app['swiftmailer.options'] = array(
    'host'       => 'mail.agrokaam.com',
    'username'   => 'noreply@agrokaam.com',
    'password'   => '20kaam13agro+*]',
    'encryption' => null,
    'auth_mode'  => 'login'
);

// Translator service config
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', __DIR__.'/locales/es.yml', 'es');
    $translator->addResource('yaml', __DIR__.'/locales/en.yml', 'en');
    return $translator;
}));
