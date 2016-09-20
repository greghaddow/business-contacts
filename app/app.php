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
	return $app['twig']->render('index.html.twig');
})->bind('homepage');


$app->get('/contact/{id}', function ($id) use ($app) {
	$sql = "SELECT c.first_name, c.last_name, o.name AS organisation_name
FROM contacts c 
LEFT JOIN organisations o ON (o.id=c.organisation_id) 
WHERE c.id = ?";
	$contact = $app['db']->fetchAssoc($sql, array((int) $id));
	
	return $app['twig']->render('contact.html.twig', $contact);
})->bind('contact');

$app->get('/contacts', function () use ($app) {
	$sql = "SELECT * FROM contacts";
	$contacts = $app['db']->fetchAll($sql);
	return $app['twig']->render('contacts-list.html.twig', array('contacts' => $contacts));
})->bind('contacts');


$app->get('/organisations', function () use ($app) {
	$sql = "SELECT * FROM organisations";
	$organisations = $app['db']->fetchAll($sql);
	return $app['twig']->render('organisations-list.html.twig', array('organisations' => $organisations));
})->bind('organisations');

$app->get('/organisation/{id}', function ($id) use ($app) {
	$sql = "SELECT * FROM organisations LEFT JOIN contacts 
ON (contacts.id=organisations.primary_contact_id) WHERE organisations.id = ? LIMIT 1";
	$contact = $app['db']->fetchAssoc($sql, array((int) $id));
	return $app['twig']->render('organisation.html.twig', $contact);
})->bind('organisation');

return $app;