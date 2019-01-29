<?php

namespace Tests\E2E;

use Server\Request;
use Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class PostTest
 * @package Tests\E2E
 */
class PostTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \Exception
     */
    public function testGetPost()
    {
        $query = <<< EOF
{
  post(id: 1) {
    id
    title
    content
    date
  }
}
EOF;
        $_POST = ['query' => $query, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }

    /**
     * @throws \Exception
     */
    public function testCreatePost()
    {
        $mutation = <<< EOF
mutation CreatePost(\$postInput: PostInputType) {
  createPost(input: \$postInput) {
    id
    title
  }
}
EOF;
        $variables = [
            'postInput' => [
                'title' => 'test title',
                'content' => 'test content',
                'authorId' => '1'
            ]
        ];

        $_POST = ['query' => $mutation, 'variables' => $variables ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }

    /**
     * @throws \Exception
     */
    public function testDeletePost()
    {
        $mutation = <<< EOF
mutation {
  deletePost(id: "11") {
    id
    title
    content
    date
  }
}
EOF;
        $_POST = ['query' => $mutation, 'variables' => '' ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }
}