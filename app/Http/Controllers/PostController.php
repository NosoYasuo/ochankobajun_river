<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Goutte;
use Illuminate\Support\Facades\Mail;
use App\Mail\CautionMail;

class PostController extends Controller
{
    public function run_scrape(){
        $url = "https://www.kasen-suibo.metro.tokyo.lg.jp/im/tsim0101g_suiishuchi.html";

        try {
            $crawler = Goutte::request('GET', $url);
        } catch (Exception $ex) {
            error_log(__METHOD__ . ' Exception was encountered: ' . get_class($ex) . ' ' . $ex->getMessage());
        }

        if (count($crawler->filter('td.bColorThinBlue'))) {
            $title =  $crawler->filter('td.bColorThinBlue')->text();
        } else {
            $title = "水位周知河川";
        }

        if (count($crawler->filter('td.widthWarningInfo'))) {
            $info =  $crawler->filter('td.widthWarningInfo')->last()->text();
        } else {
            $info = "取得できませんでした";
        }
        return [$title, $info];
    }

    public function index()
    {
        list($title, $info) = $this->run_scrape();

        $posts = Post::withCount('likes')->withCount('comments')->where('caution', 0)->orderBy('id', 'desc')->take(10)->get();
        return view('index', ['posts' => $posts, 'title' => $title, 'info' => $info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:50',
                'message' => 'required|max:140',
                'river_id' => 'required',
            ]);

        //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }

        //画像の扱いに関して
        if ($file = $request->file_name) {
            $fileName = $request->file('file_name')->store('uploads', "public");
        } else {
            //画像が登録されなかった時はから文字をいれる
            $fileName = "";
        }

        //file extension を定義
        if (preg_match('/\.(jpg|jpeg|png|heic)$/i', $fileName)) {
            $file_ext = 1;
        } elseif (preg_match('/\.(avi|mp4|mov|wmv)$/i', $fileName)) {
            $file_ext = 2;
        } elseif ($request->y_id) {
            $file_ext = 3;
        }else {
            $file_ext = "";
        }

        if(!$request->caution){
            $request->caution=0;
        }


        $user = Auth::user();
        $posts = new Post;
        $posts->title = $request->title;
        $posts->message = $request->message;
        $posts->file_name = $fileName;
        $posts->y_id = $request->y_id;
        if ($file_ext) {
            $posts->file_ext = $file_ext;
        }
        $posts->river_id = $request->river_id;
        $posts->address = $request->address;
        $posts->latitude = $request->latitude;
        $posts->longitude = $request->longitude;
        $posts->user_id = $user->id;
        $posts->user_name = $user->name;
        $posts->caution = $request->caution;
        $posts->save();

        if ($request->caution == 1) {
            Mail::to("kobajunoasis@yahoo.co.jp")->send(new CautionMail($posts));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    //myriverへ移動
    public function myRiver($river_id)
    {
        $posts = Post::withCount('likes')->withCount('comments')->where('caution', 0)->where('river_id', $river_id)->orderBy('id', 'desc')->get();
        return view('myriver', ['posts' => $posts, 'river_id' => $river_id]);
    }

    //mypageへ移動
    public function myPage()
    {
        $posts = Post::withCount('likes')->withCount('comments')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('mypage', ['posts' => $posts]);
    }

    //コメント記入
    public function comment(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:140',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $user = Auth::user();
        $comments = new Comment;
        $comments->comment = $request->comment;
        $comments->user_id = $user->id;
        $comments->user_name = $user->name;
        $comments->post_id = $request->post_id;
        $comments->save();
        return redirect('/');
    }

    public function scrape(){

        list($title, $info) = $this->run_scrape();

        $posts = Post::withCount('likes')->withCount('comments')->where('caution', 1)->orderBy('id', 'desc')->get();

        return view('info', ['title' => $title, 'info' => $info, 'posts' => $posts]);
    }

}
