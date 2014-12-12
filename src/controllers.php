<?php

/**
 * 2bi Smart IT web.
 * 
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// -- PORTADA ------------------------------------------------------------------
$app->get('/{_locale}', function (Request $request) use ($app) {
    return $app['twig']->render('content.twig', array());
})
->bind('home');

$app->get('/', function (Request $request) use ($app) {
    return $app->redirect($app['url_generator']->generate('home', array('_locale' => $app['locale'])));
})
->bind('start');

// -----------------------------------------------------------------------------
$app->post('/contact', function (Request $request) use ($app) {
	// Obtenemos los datos del formulario
	$name = $request->get('name');
	$email = $request->get('email');
	$phone = $request->get('phone');
	$messageText = $request->get('message');
	
	// Construimos el cuerpo del mensaje
	$body = "<h1>Contacto desde 2bi.es</h1><hr>";
	$body .= "<h3>Datos del contacto:</h3>";
	$body .= "Nombre: <strong>".$name."</strong><br>";
	$body .= "Email: <strong>".$email."</strong><br>";
	$body .= "Teléfono: <strong>".$phone."</strong><hr>";
	$body .= "<h3>Mensaje:</h3>";
	$body .= "".$messageText;

	$message = \Swift_Message::newInstance()
		->setContentType('text/html')
		->setCharset('UTF-8')
        ->setSubject('Contacto desde 2bi.es')
        ->setFrom(array('soporte@2bi.es' => '2bi Smart IT Website'))
        ->setTo($app['default_contact'])
        ->setBody($body);

    $result = $app['mailer']->send($message);

    return $app->json($result);
})
->bind('contact');
