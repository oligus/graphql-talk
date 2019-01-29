<?php

namespace Tests\E2E;

use Server\Request;
use Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class AuthorsTest
 * @package Tests\E2E
 */
class AuthorsTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \Exception
     */
    public function testGetAuthors()
    {
        $query = <<< EOF
{
  authors {
    total
    count
    nodes {
      id
      name
    }
  }
}
EOF;
        $_POST = ['query' => $query, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }
}