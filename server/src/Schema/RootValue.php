<?php

namespace Server\Schema;

/**
 * Class RootValue
 * @package Server\Schema
 */
class RootValue
{
    public function moo()
    {

        return [
            'author' => function($root, $args, $context) {

            echo "author";
            },
            'echo' => function($root, $args, $context) {
                $echo = new Echoer();

                return $echo->resolve($root, $args, $context);
            },
            'prefix' => 'You said: ',
        ];
    }
}