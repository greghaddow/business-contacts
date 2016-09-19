<?php
require_once __DIR__.'/../vendor/autoload.php';
// web/app.php
use Symfony\Component\HttpFoundation\Response;
use BusinessContacts\Entity\Contact;
use BusinessContacts\Entity\Organisation;

// set the error handling
ini_set('display_errors', 1);
error_reporting(-1);


$app = new Silex\Application();
$app['debug'] = true;

// ... definitions

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver'   => 'pdo_mysql',
		'host'      => 'localhost',
		'dbname'    => 'business-address-book',
		'user'      => 'root',
		'password'  => 'southpark',
		'charset'   => 'utf8mb4',
	),
));

$app->get('/', function () use ($app) {

	return  new Response("<h1>Business Contacts</h1>".
	"<p>Contacts</p>".
	"<p>Businesses</p>");
})->bind('homepage');


$app->get('/contacts/{id}', function ($id) use ($app) {
	$sql = "SELECT * FROM contact WHERE id = ?";
	$contact = $app['db']->fetchAssoc($sql, array((int) $id));

	return  "<h1>{$contact['first_name']}</h1>".
	"<p>{$contact['email']}</p>";
})->bind('contact');

return $app;