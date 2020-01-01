<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        // とりあえず全件
        return $this->queryResult(
            Blog::select([
                "blogs.id",
                "blogs.title",
                "blogs.body",
                "blogs.created_by",
                "blogs.created_at",
                DB::raw("IFNULL(blog_favorites.is_favorite, 0) as is_favorite"),
                DB::raw("IFNULL(blog_likes.is_like, 0) as is_like")
            ])->leftJoin("blog_favorites", function ($join) {
                $join->on("blog_favorites.blog_id", "blogs.id");
                $join->where("blog_favorites.user_id", "=", $this->_user->getAuthIdentifier());
            })->leftJoin("blog_likes", function ($join) {
                $join->on("blog_likes.blog_id", "blogs.id");
                $join->where("blog_likes.user_id", "=", $this->_user->getAuthIdentifier());
            })->where("created_by", "<>", $this->_user->getAuthIdentifier())->get()
        );
    }

    /**
     * 自分のブログを取得する。
     * @return array
     */
    public function myBlog()
    {
        return $this->queryResult(Blog::where("created_by", $this->_user->getAuthIdentifier())->get());
    }

    /**
     * ブログの詳細を取得(投稿含めてとってくるr)
     * @param $id
     * @return array
     */
    public function showDetail($id)
    {
        return $this->queryResult([
            "blog" => Blog::find($id),
            "posts" => Post::where("blog_id", $id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {

        // バリデーション
        // 成功メッセージとか失敗メッセージとか設定して投げれば良いんではないだろうか。
        return $this->withTransaction(function () use ($request) {
            $store = Blog::make()->fill($request->all());
            $store->created_by = $this->_user->getAuthIdentifier();
            $store->updated_by = $this->_user->getAuthIdentifier();
            $store->saveOrFail();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //とりあえずある前提
        return $this->queryResult(
            Blog::select(["title", "body"])
                ->where("id", $id)
                ->first()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
