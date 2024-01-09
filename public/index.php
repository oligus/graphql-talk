<?php declare(strict_types=1);

use GraphQL\Error\DebugFlag;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Utils\BuildSchema;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Custom\TypeConfigDecorator;
use Oligus\GraphqlTalk\RootResolver;
use Jajo\JSONDB;

error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

if (!defined('SRC_PATH')) {
    define('SRC_PATH', dirname(__DIR__) . '/src');
}

$schemaFile = file_get_contents(SRC_PATH . '/schema.graphqls');
$schema = BuildSchema::build($schemaFile, TypeConfigDecorator::resolve());

$context = new AppContext();
$context->setJsonDB(new JSONDB( __DIR__ . '/../data' ));

$config = ServerConfig::create()
    ->setSchema($schema)
    ->setRootValue(RootResolver::resolve())
    ->setContext($context)
    ->setDebugFlag(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE)
;

$server = new StandardServer($config);
$server->handleRequest();
