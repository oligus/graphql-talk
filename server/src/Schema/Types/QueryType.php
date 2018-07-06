<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\Fields\Track;
use Server\Schema\Fields\Genre;
use Server\Schema\Fields\Genres;
use Server\Schema\Fields\MediaType;
use Server\Schema\Fields\MediaTypes;
use Server\Schema\Fields\Album;
use Server\Schema\Fields\Albums;
use Server\Schema\Fields\Artist;
use Server\Schema\Fields\Artists;
use Server\Schema\Fields\PlayList;
use Server\Schema\Fields\PlayLists;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class QueryType
 * @package Server\Schema\Types
 */
class QueryType extends ObjectType
{
    /**
     * QueryType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'track' => Track::getField(),
                'genre' => Genre::getField(),
                'genres' => Genres::getField(),
                'mediaType' => MediaType::getField(),
                'mediaTypes' => MediaTypes::getField(),
                'album' => Album::getField(),
                'albums' => Albums::getField(),
                'artist' => Artist::getField(),
                'artists' => Artists::getField(),
                'playList' => PlayList::getField(),
                'playLists' => PlayLists::getField()
            ]
        ];

        parent::__construct($config);

    }
}
