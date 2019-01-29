<?php

namespace Tests\E2E;

use Server\Request;
use Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * Class CommentTest
 * @package Tests\E2E
 */
class CommentTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @throws \Exception
     */
    public function testGetComment()
    {
        $query = <<< EOF
{
  comment(id: 1) {
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
    public function testCreateComment()
    {
        $mutation = <<< EOF
mutation(\$input: CommentInputType) {
  createComment(input: \$input) {
    id
    title
  }
}
EOF;
        $variables = [
            'input' => [
                'title' => 'test title',
                'content' => 'test content',
                'authorId' => '1',
                'postId' => 1
            ]
        ];

        $_POST = ['query' => $mutation, 'variables' => $variables ];
        $this->assertMatchesJsonSnapshot(Request::serve());
    }

    /**
     * @throws \Exception
     */
    public function testDeleteComment()
    {
        $mutation = <<< EOF
mutation {
  deleteComment(id: "1") {
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