<?php
require_once __DIR__.'/vendor/autoload.php';
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Provider\FormServiceProvider;

$app = new Silex\Application();

$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	'locale_fallbacks' => array('en'),
));
//// ... definitions
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
$app['orm.proxies_dir'] = __DIR__.'/cache/doctrine/proxies';
$app['orm.default_cache'] = 'array';
$app['orm.em.options'] = array(
	'mappings' => array(
		array(
			'type' => 'annotation',
			'path' => __DIR__.'/src/BusinessContacts/Entity',
			'namespace' => 'BusinessContacts\Entity',
			'use_simple_annotation_reader' => false
		),
	),
);

$app->register(
	new ConsoleServiceProvider(),
	array(
		'console.name' => 'bc',
		'console.version' => '0.1.0',
		'console.project_directory' => __DIR__ . "/.."
	)
);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/src/BusinessContacts/views',
));

// your beautiful silex bootstrap

return $app;

?>