<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        $posts_count = $posts->total();
        $avatar = Storage::disk('s3')->url('avatars/' . $user->avatar);
        return view('user.index', compact('posts', 'user', 'posts_count', 'avatar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user->id !== Auth::id()) {
            return redirect()->route('user.index', ['id' => Auth::id()])->with('success', '権限がありません');
        }
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
		$user->fill(['name' => $request->name]);
		$user->fill(['profile' => $request->profile]);
        $user->save();
        return redirect()->route('user.index', ['id' => $user->id])->with('success', '編集しました');
    }
}
