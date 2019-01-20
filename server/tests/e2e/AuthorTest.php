<?php

namespace Tests\E2E;

use Server\Request;
use Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class AuthorTest
 * @package Tests\E2E
 */
class AuthorTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \Exception
     */
    public function testGetAuthor()
    {
        $query = <<< EOF
{
  author(id: 1) {
    name
  }
}
EOF;
        $_POST = ['query' => $query, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }

    /**
     * @throws \Exception
     */
    public function testCreateAuthor()
    {
        $mutation = <<< EOF
mutation {
  createAuthor(name: "Test Testsson") {
    id
    name
  }
}
EOF;
        $_POST = ['query' => $mutation, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }

    public function testDeleteAuthor()
    {
        $mutation = <<< EOF
mutation {
  deleteAuthor(id: "11") {
    id
    name
  }
}
EOF;
        $_POST = ['query' => $mutation, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }
}