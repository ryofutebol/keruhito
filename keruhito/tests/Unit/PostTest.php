<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $posts = factory(Post::class)->create();
        $this->Post = new Post();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function testIndex()
    // {
    //     $data = $this->Post->all();

    //     $expected = [
    //         'user_id', 'title', 'content', 'image',
    //     ];

    //     // $this->assertSame($expected, array_keys($data));
    //     $this->assertTrue($data);
    // }

    public function testCreate()
    {
        $posts = [
            'user_id' => '1',
            'title' => 'member1',
            'content' => 'content',
            'image' => 'image.jpg',
        ];
        $this->Post->insert($posts);

        $this->assertDatabaseHas('posts', $posts);
    }
}
