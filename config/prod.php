<?php

use Silex\Provider\MonologServiceProvider;

// descomenta las siguientes líneas para activar la depuración
// en el entorno de producción
$app['debug'] = true;
$app->register(new MonologServiceProvider(), array(
     'monolog.logfile' => __DIR__.'/../logs/prod.log',
));

// Añadir a continuación cualquier otra opción de configuración de producción
// **********************************************************************************
 
// Título de la aplicación
$app['title'] = '2bi Smart IT';

// Destinatario formulario de contacto: comercial@2bi.es
$app['default_contact'] = 'comercial@2bi.es';

// Swiftmailer config
$app['swiftmailer.options'] = array(
    'host'       => 'mail.agrokaam.com',
    'username'   => 'noreply@agrokaam.com',
    'password'   => '20kaam13agro+*]',
    'encryption' => null,
    'auth_mode'  => 'login'
);
