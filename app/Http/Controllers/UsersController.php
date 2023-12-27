<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    //  public function profile(Int $user_Id)
     public function profile()
    {
        // $user = auth()->user();
        //リンク元のidを元にユーザー情報を取得する
        // $users = User::where('id', $user_Id)->first();
        // dd($users);
        //リンク元ユーザーのidを元に投稿内容を取得する
        // $posts = Post::with('user')->where('user_id', $user_Id)-> latest('updated_at')-> get();
        //dd($posts);
        // return view('users.profile', compact('users', 'posts'));
        return view('users.profile');

    }

    public function show($id)
    {
        // 特定のユーザーをデータベースから取得
        $user = User::findOrFail($id);

        // ユーザー情報をビューに渡す
        return view('profile.show', compact('user'));

    }

//ユーザー検索の実装のコード
    public function search(Request $request)
{
    $searchWord = $request->input('searchWord');
    if ($searchWord) {
        $users = User::where('username', 'like', '%' . $searchWord . '%')
                     ->get();
    } else {
        $users = User::where('id', '!=', Auth::id())->get();
    }
    return view('users.search', compact('users', 'searchWord'));
}

    public function follow(User $user,$id)
    {
        if (Auth::check()) {
        // $request->user()->following()->attach($user->id);
        }
        $following=auth()->user();//$followingは変数あだ名をつけている
        $following->follow($id);//idを使ってフォローしといてという意味

        return redirect('/search');//毎回検索画面に戻るようにリダイレクトしている
    }

    public function unfollow($id)//入力フォームで送っていないためREQUEST $REQUEST入らない
    {
        if (Auth::check()) {
        $user = User::findOrFail($id);
        $following=auth()->user();
        $following->unfollow($id);
        }
        return back();
    }

    //プロフィール編集更新機能
    public function profileEdit(Request $request){
        $request->validate([
        'username' => 'required|string|min:2|max:12',
        'mail' => 'required|email|unique:users,mail|min:5|max:40',
        'password' => 'required|regex:/^[a-zA-Z0-9]+$/|confirmed|min:8|max:20',
        'bio' =>  'max:150',
        'images' => 'image|mimes:jpg,png,bmp,gif,svg',
    ]);
            $id=$request->input('id');
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->password; // パスワードの取得方法を修正
            $bio=$request->input('bio');
            $filename=$request->images->getClientOriginalName();
            // dd($filename);
            // $images = $request->images->getClientOriginalName();
            // dd($images);

        if ($request->hasFile('images')) {
        // アップロードされた画像が存在する場合の処理
            $filename = $request->images->getClientOriginalName();
            $images = $request->images->storeAs('user-images', $filename, 'public');
        } else {
        // アップロードがなければ元の画像を使用するか、nullにするか、任意のデフォルト画像を設定するなどの処理を行う。
            $images = null;
            // $images = 'user-images/default-image.jpg';
    }
            // パスワードをハッシュ化
            $hashedPassword = Hash::make($password);

        User::where('id', $id)->update
            (['username' => $username, 'mail' => $mail, 'password' => $hashedPassword, 'bio' => $bio, 'images' => $filename]);

        return redirect('/top');//更新を押したらTOPに戻る
        }
}
