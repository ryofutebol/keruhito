<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * twitterの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $twitter_user = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect(route('auth.twitterLogin'));
        }

        $url = $twitter_user->avatar_original;
        $file_name = substr(strrchr($url, '/'), 1);
        $img = file_get_contents($url);
        $file_path = storage_path('app/public/avatars/' . $file_name);

        //Twitterデータを取得・保存
        $user = User::firstOrCreate([
            'twitter_id' => $twitter_user->id,
        ], [
            'name' => $twitter_user->name,
            'access_token' => $twitter_user->token,
            'access_token_secret' => $twitter_user->tokenSecret,
            'avatar' => $file_name,
        ]);
        //画像をサーバーに保存
        if ($user->wasRecentlyCreated == true || $user->avatar != $file_name) {
            Storage::delete('public/avatars/' . $user->avatar);
            Storage::put('public/avatars/' . $file_name, $img);
            $user->update(['avatar' => $file_name]);
        }
        \Auth::login($user, true);
        return redirect(route('post.index'));
    }
}
