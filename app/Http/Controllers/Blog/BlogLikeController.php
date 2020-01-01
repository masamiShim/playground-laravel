<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Blog_Like;
use Illuminate\Http\Request;

class BlogLikeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return $this->queryResult(function () use ($request) {
            $model = Blog_Like::where('user_id', $this->_user->getAuthIdentifier());
            if ($request->filled("blog_id")) {
                $model = $model->where("blog_id", $request["blog_id"]);
            }
            return $model->get();
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        return $this->withTransactionNotNotify(function () use ($request) {
            $exists = Blog_Like::where("blog_id", $request['blog_id'])
                ->where('user_id', $this->_user->getAuthIdentifier())->first();

            if (is_null($exists)) {
                $store = Blog_Like::make();
                $store->blog_id = $request["blog_id"];
                $store->user_id = $this->_user->getAuthIdentifier();
                $store->is_like = true;
                $store->saveOrFail();
            } else {
                $exists->is_like = !$exists->is_like;
                $exists->saveOrFail();
            }
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
        //
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
