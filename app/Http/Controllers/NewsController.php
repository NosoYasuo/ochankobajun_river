<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NewsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');  // 要ログイン

    }

    public function subscription(Request $request)
    {
        // $this->validate($request, [
        //     'endpoint'    => 'required',
        //     'keys.auth'   => 'required',
        //     'keys.p256dh' => 'required'
        // ]);

        // $endpoint = $request->endpoint;
        // $token = $request->keys['auth'];
        // $key = $request->keys['p256dh'];
        // $user = $request->user();
        // $user->updatePushSubscription($endpoint, $key, $token);

        // return response()->json([
        //     'success' => true
        // ], 200);

        $user = Auth::user();
        $endpoint = $request->endpoint;
        $key = $request->key;
        $token = $request->token;
        $user->updatePushSubscription($endpoint, $key, $token);

        return ['result' => true];
    }
}
