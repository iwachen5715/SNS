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
         $user = Auth::user();
        //リンク元のidを元にユーザー情報を取得する
        // $users = User::where('id', $user_Id)->first();
        // dd($users);
        //リンク元ユーザーのidを元に投稿内容を取得する
        // $posts = Post::with('user')->where('user_id', $user_Id)-> latest('updated_at')-> get();
        //dd($posts);
        // return view('users.profile', compact('users', 'posts'));
        return view('users.profile', compact('user'));

    }

    public function show($id)
    {
        // 特定のユーザーをデータベースから取得
        $user = User::findOrFail($id);
        $posts = $user->posts;

        // ユーザー情報をビューに渡す
        return view('users.otherprofile', compact('user','posts'));

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
    ], [
        'username.required' => 'ユーザー名を入力してください。',
        'username.string' => 'ユーザー名は文字列で入力してください。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以下で入力してください。',
        'mail.required' => 'メールアドレスを入力してください。',
        'mail.email' => '有効なメールアドレスを入力してください。',
        'mail.unique' => 'このメールアドレスはすでに使用されています。',
        'mail.min' => 'メールアドレスは5文字以上で入力してください。',
        'mail.max' => 'メールアドレスは40文字以下で入力してください。',
        'password.required' => 'パスワードを入力してください。',
        'password.regex' => 'パスワードは英数字のみ使用できます。',
        'password.confirmed' => 'パスワードと確認用パスワードが一致しません。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以下で入力してください。',
        'bio.max' => '自己紹介は150文字以下で入力してください。',
        'images.image' => '画像ファイルを選択してください。',
        'images.mimes' => '画像ファイルはjpg、png、bmp、gif、svg形式である必要があります。',
    ]);

    // フォームデータから入力された情報を取得
    $id = $request->input('id');
    $username = $request->input('username');
    $mail = $request->input('mail');
    $password = $request->input('password'); // パスワードの取得方法を修正
    $bio = $request->input('bio');
    $filename = $request->images->getClientOriginalName();

    // アップロードされた画像があるかどうかを確認して処理
    if ($request->hasFile('images')) {
        // アップロードされた画像が存在する場合の処理
        $filename = $request->images->getClientOriginalName();
        $images = $request->images->storeAs('user-images', $filename, 'public');
    } else {
        // アップロードがない場合の処理
        $images = null;
    }

    // パスワードをハッシュ化
    $hashedPassword = Hash::make($password);

    // imagesがnullでない場合は、imagesのファイル名を更新データに含める
    if ($images !== null) {
        User::where('id', $id)->update(['username' => $username, 'mail' => $mail, 'password' => $hashedPassword, 'bio' => $bio, 'images' => $filename]);
    } else {
        // imagesがnullの場合は、imagesは更新しない
        User::where('id', $id)->update(['username' => $username, 'mail' => $mail, 'password' => $hashedPassword, 'bio' => $bio]);
    }

    // 更新が完了したらトップページにリダイレクトする
    return redirect('/top');
}
}
