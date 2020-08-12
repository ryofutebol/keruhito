<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $file_name = mt_rand() . '.jpg';
        $post = $request->all();
        if ($request->twitter_flag == true) {
            $twitter = new TwitterOAuth(
                env('TWITTER_CLIENT_ID'),
                env('TWITTER_CLIENT_SECRET'),
                Auth::user()->access_token,
                Auth::user()->access_token_secret
            );
            $player_name = '【' . $request->title . "】\n";
            $tweet_content = $player_name . $request->content;
            $tweet_check = $twitter->post('statuses/update', array('status' => $tweet_content));
        }
        $post['image'] = $file_name;
        Storage::disk('s3')->putFileAs('images/', $request->file('image'), $file_name, 'public');
        Post::create($post);
        return redirect()->route('post.index')->with('success', '投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $show_post = Storage::disk('s3')->url('images/' . $post->image);
        return view('post.show', compact('post', 'show_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $file_name = $post->image;
        $this->authorize('update', $post);
        if ($request->file('image')) {
            $file_name = mt_rand() . '.jpg';
            Storage::delete('public/images/' . $post->image);
            Storage::disk('s3')->putFileAs('images/', $request->file('image'), $file_name, 'public');
        }
		$post->fill(['title' => $request->title]);
		$post->fill(['content' => $request->content]);
		$post->fill(['image' => $file_name]);
        $post->save();
        return redirect()->route('post.show', ['id' => $post->id])->with('success', '編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('post.index')->with('success', '削除しました');
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
                    ->orWhere('content', 'like', "%{$request->search}%")
                    ->paginate(10);

        $search_result = '"' . $request->search . '"の検索結果：' . $posts->total() . '件';
        return view('post.index', compact('posts', 'search_result'));
    }
}
