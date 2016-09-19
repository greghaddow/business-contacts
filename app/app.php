<?php
require_once __DIR__.'/../vendor/autoload.php';
// web/app.php
use Symfony\Component\HttpFoundation\Response;
use BusinessContacts\Entity\Contact;
use BusinessContacts\Entity\Organisation;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

// set the error handling
ini_set('display_errors', 1);
error_reporting(-1);


$app = new Silex\Application();
$app['debug'] = true;

// ... definitions
$app->register(new DoctrineOrmServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver'   => 'pdo_mysql',
		'host'      => 'mariadb',
		'dbname'    => 'business-contacts',
		'user'      => 'root',
		'password'  => '',
		'charset'   => 'utf8mb4',
	),
));
$app['orm.proxies_dir'] = __DIR__.'/../cache/doctrine/proxies';
$app['orm.default_cache'] = 'array';
$app['orm.em.options'] = array(
	'mappings' => array(
		array(
			'type' => 'annotation',
			'path' => __DIR__.'/../src',
			'namespace' => 'BusinessContacts',
		),
	),
);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../src/BusinessContacts/views',
));

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

return $app;