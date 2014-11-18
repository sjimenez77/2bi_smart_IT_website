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

// -- PORTADA -----------------------------------------------------------------
$app->get('/{_locale}', function (Request $request) use ($app) {
    return $app['twig']->render('content.twig', array());
})
->bind('home');

$app->get('/', function (Request $request) use ($app) {
    return $app->redirect($app['url_generator']->generate('home', array('_locale' => $app['locale'])));
})
->bind('start');

// -----------------------------------------------------------------------------
$app->post('/contacto', function (Request $request) use ($app) {
	// Obtenemos los datos del formulario
	$nombre = $request->get('nombre');
	$empresa = $request->get('empresa');
	$email = $request->get('email');
	$tel = $request->get('tel');
	$asunto = $request->get('asunto');
	$mensaje = $request->get('mensaje');
	
	// Construimos el cuerpo del mensaje
	$body = "<h1>2bi Smart IT: ".$asunto."</h1><hr>";
	$body .= "Nombre: <strong>".$nombre."</strong><br>";
	$body .= "Empresa: <strong>".$empresa."</strong><br>";
	$body .= "Email: <strong>".$email."</strong><br>";
	$body .= "Teléfono: <strong>".$tel."</strong><hr>";
	$body .= "".$mensaje;

	$message = \Swift_Message::newInstance()
		->setContentType('text/html')
		->setCharset('UTF-8')
        ->setSubject($asunto)
        ->setFrom(array('noreply@agrokaam.com'))
        ->setTo($app['default_contact'])
        ->setBody($body);

    $app['mailer']->send($message);

    return $app -> redirect($app['url_generator']->generate('portada'));
})
->bind('contacto');

// -----------------------------------------------------------------------------

$app->post('/formacion', function (Request $request) use ($app) {
	// Obtenemos los datos del formulario
	$nombre = $request->get('inscripcion_nombre');
	$email = $request->get('inscripcion_email');
	$tel = $request->get('inscripcion_tel');
	$localidad = $request->get('inscripcion_localidad');
	
	// Construimos el cuerpo del mensaje
	$body = "<h1>Inscripción a jornadas de difusión</h1><hr>";
	$body .= "Nombre y apellidos: <strong>".$nombre."</strong><br>";
	$body .= "Email: <strong>".$email."</strong><br>";
	$body .= "Teléfono: <strong>".$tel."</strong><hr>";
	$body .= "Desearía inscribirme en las jornadas de difusión en <strong>".$localidad."</strong> y fecha indicados.";

	$message = \Swift_Message::newInstance()
		->setContentType('text/html')
		->setCharset('UTF-8')
        ->setSubject('Inscripción a jornadas de difusión')
        ->setFrom(array('noreply@agrokaam.com'))
        ->setTo($app['default_contact'])
        ->setBody($body);

    $app['mailer']->send($message);

    return $app -> redirect($app['url_generator']->generate('portada'));
})
->bind('formacion');