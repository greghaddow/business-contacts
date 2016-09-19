<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
echo 'hello';
$app = new Silex\Application();

// ... definitions

$app->run();

