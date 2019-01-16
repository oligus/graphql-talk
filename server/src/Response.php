<?php declare(strict_types=1);

namespace Server;

use Server\Schema\AppContext;
use Server\Schema\Types\MutationType;
use Server\Schema\Types\QueryType;
use Server\Helpers\JsonHelper;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Error\Debug;

/**
 * Class Response
 * @package Server
 */
class Response
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * Response constructor.
     * @param $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        $appContext = new AppContext();
        $appContext->rootUrl = 'http://localhost:8080';
        $appContext->request = $_REQUEST;

        // GraphQL schema to be passed to query executor:
        $schema = new Schema([
            'query' => new QueryType(),
            'mutation' => new MutationType()
        ]);

        $result = GraphQL::executeQuery(
            $schema,
            $this->data['query'],
            null,
            $appContext,
            JsonHelper::toArray($this->data['variables'])
        );

        $debug = Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE;

        return $result->toArray($debug);
    }
}
