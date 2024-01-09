<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk;

use Jajo\JSONDB;

class AppContext
{
    private JSONDB $jsonDB;

    public function getJsonDB(): JSONDB
    {
        return $this->jsonDB;
    }

    public function setJsonDB(JSONDB $jsonDB): void
    {
        $this->jsonDB = $jsonDB;
    }
}
