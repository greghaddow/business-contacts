<?php
$app = require_once dirname(__DIR__) ."/bootstrap.php";
// web/app.php
use Symfony\Component\HttpFoundation\Response;
use BusinessContacts\Entity\Contact;
use BusinessContacts\Entity\Organisation;

// set the error handling
ini_set('display_errors', 1);
error_reporting(-1);


$app['debug'] = true;



$app->get('/', function () use ($app) {
	return  new Response("<h1>Business Contacts</h1>".
	"<p>Contacts</p>".
	"<p>Businesses</p>");
})->bind('homepage');


$app->get('/contacts/{id}', function ($id) use ($app) {
	$sql = "SELECT * FROM contact WHERE id = ?";
	$contact = $app['db']->fetchAssoc($sql, array((int) $id));
	return $app['twig']->render('contact.html.twig', $contact);
})->bind('contact');

$app->get('/contacts', function () use ($app) {
	$sql = "SELECT * FROM contact";
	$contacts = $app['db']->fetchAll($sql);
	return $app['twig']->render('contacts-list.html.twig', array('contacts' => $contacts));
})->bind('contact');

return $app;