<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [realpath(__DIR__ . '/src/Modules')];
$conn = ['url' => 'sqlite:///' . __DIR__ . '/data/chinook.db'];

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"),
    $isDevMode = true,
    $proxyDir = null,
    $cache = null,
    $useSimpleAnnotationReader = false
);

$em = EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($em);
