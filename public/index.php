<?php declare(strict_types=1);

error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

if (!defined('SRC_PATH')) {
    define('SRC_PATH', dirname(__DIR__) . '/src');
}

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use GraphQL\Error\DebugFlag;
use GraphQL\Language\Parser;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Utils\BuildSchema;
use GraphQL\Utils\SchemaExtender;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\RootResolver;

$paths = [realpath(__DIR__ . '/../src/Modules')];
$conn = ['url' => 'sqlite:///' . __DIR__ . '/../data/chinook.db'];

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src"),
    $isDevMode = true,
    $proxyDir = null,
    $cache = null,
    $useSimpleAnnotationReader = false
);
$em = EntityManager::create($conn, $config);

$schemaFile = file_get_contents(SRC_PATH . '/Api/schema.graphqls');
$schema = BuildSchema::build($schemaFile);

$extendedSchemasDirectory = SRC_PATH . '/Api/Schema/';

foreach (scandir($extendedSchemasDirectory) as $schemaFile) {
    if (!is_dir($schemaFile)) {
        $extendedSchemaFile = file_get_contents($extendedSchemasDirectory . $schemaFile);

        if (!$extendedSchemaFile) {
            continue;
        }

        $schema = SchemaExtender::extend($schema, Parser::parse($extendedSchemaFile));
    }
}
$context = new AppContext();
$context->setEm($em);

$config = ServerConfig::create()
    ->setSchema($schema)
    ->setRootValue(RootResolver::resolve())
    ->setContext($context)
    ->setDebugFlag(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE)
;

$server = new StandardServer($config);
$server->handleRequest();
