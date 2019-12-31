<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $_user;

    public function __construct()
    {
        $this->_user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {

        // バリデーション
        // 成功メッセージとか失敗メッセージとか設定して投げれば良いんではないだろうか。
        return $this->withTransaction(function () use ($request) {
            $store = Post::make()->fill($request->all());
            $store->created_by = $this->_user->getAuthIdentifier();
            $store->updated_by = $this->_user->getAuthIdentifier();
            $store->saveOrFail();
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
