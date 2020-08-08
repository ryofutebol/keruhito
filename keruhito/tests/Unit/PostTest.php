<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(Post::class)->create();
        $this->Post = new Post();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testIndex()
    {
        $post = $this->Post->first();
        $expected = [
            'id', 'user_id', 'title', 'content', 'image', 'twitter_id', 'twitter_flag', 'created_at', 'updated_at'
        ];
        $array = json_decode(json_encode($post), true);
        $this->assertSame($expected, array_keys($array));
    }
    
    /**
    * @test
    */

    // // innsert処理
    public function testCreate()
    {
        $posts = [
            'user_id' => '4',
            'title' => 'member1',
            'content' => 'content',
            'image' => 'image.jpg',
        ];
        $this->Post->insert($posts);

        $this->assertDatabaseHas('posts', $posts);
    }

    /**
    * @test
    */

    // update処理
    public function testUpdate()
    {
        $post = factory(Post::class)->create();
        $posts = [
            'title' =>  $post->title,
            'content' => $post->content
        ];
        $this->Post->update($posts);
        $this->assertDatabaseHas('posts', $posts);

    }

    /**
    * @test
    */

    public function testDelete()
    {
        $post = Post::first();
        $this->Post->destroy($post->id);
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}
