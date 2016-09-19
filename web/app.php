<?php
// web/app.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

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


	return  "<h1>Business Contacts</h1>".
	"<p>Contacts</p>".
	"<p>Businesses</p>";
})->bind('homepage');


$app->get('/contacts/{id}', function ($id) use ($app) {
	$sql = "SELECT * FROM contact WHERE id = ?";
	$contact = $app['db']->fetchAssoc($sql, array((int) $id));

	return  "<h1>{$contact['first_name']}</h1>".
	"<p>{$contact['email']}</p>";
})->bind('contact');

$app->run();

