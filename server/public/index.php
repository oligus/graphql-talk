<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Server\Database\Manager;
use Server\Request;
use Server\Helpers\ErrorHelper;
use Server\Schema\Query\FilterCollection;

$paths = array(realpath(__DIR__ . '/../src/Database/Entities'));

$isDevMode = true;

$connectionParams = array(
    'url' => 'sqlite:///' . '../data/blog.db'
);

$config = Setup::createConfiguration($isDevMode);
$driver = new AnnotationDriver(new AnnotationReader(), $paths);

AnnotationRegistry::registerLoader('class_exists');
$config->setMetadataDriverImpl($driver);

$em = EntityManager::create($connectionParams, $config);

$manager = Manager::getInstance();
$manager->setEm($em);
$manager->setFilterCollection(new FilterCollection());

try {
    Request::serve();
} catch (\Exception $e) {
    var_dump($e); die;
    ErrorHelper::simple($e);
}



