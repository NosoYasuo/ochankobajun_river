<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->get();

        return view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            // //保存するファイルに名前をつける
            // $fileName = time() . '.' . $file->getClientOriginalExtension();
            // //Laravel直下のpublicディレクトリに新フォルダをつくり保存する
            // $target_path = public_path('/uploads/');
            // $file->move($target_path, $fileName);
            $fileName = $request->file('file_name')->store('uploads',"public");
        } else {
            //画像が登録されなかった時はから文字をいれる
            $fileName = "";
        }

        $posts = new Post;
        $posts->message = $request->message;
        $posts->file_name = $fileName;
        $posts->river_id = $request->river_id;
        $posts->address = $request->address;
        $posts->latitude = '59.12899900';
        $posts->longitude = '101.26384400';
        $posts->user_id = 1;
        $posts->user_name = '小林純';
        $posts->save();
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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

    public function myRiver($river_id)
    {
        $posts = Post::where('river_id', $river_id)->get();
        return view('myriver', ['posts' => $posts]);
    }
}
