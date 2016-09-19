<?php
use Doctrine\DBAL\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
$loader = require __DIR__ . '/vendor/autoload.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$app = require_once __DIR__.'/app/app.php';

$newDefaultAnnotationDrivers = array(
    __DIR__."/src/BusinessContacts",
);
$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ApcCache);

$driverImpl = $config->newDefaultAnnotationDriver($newDefaultAnnotationDrivers);
$config->setMetadataDriverImpl($driverImpl);
$config->setProxyDir($app['orm.proxies_dir']);
$config->setProxyNamespace('Proxies');
$em = \Doctrine\ORM\EntityManager::create($app['db.options'], $config);
$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
));