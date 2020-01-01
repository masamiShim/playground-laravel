<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Post_Favorite;
use Illuminate\Http\Request;

class PostFavoriteController extends Controller
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
            $model = Post_Favorite::where('user_id', $this->_user->getAuthIdentifier());
            if ($request->filled("post_id")) {
                $model = $model->where("post_id", $request["post_id"]);
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
            $exists = Post_Favorite::where("post_id", $request['post_id'])
                ->where('user_id', $this->_user->getAuthIdentifier())->first();

            if (is_null($exists)) {
                $store = Post_Favorite::make();
                $store->post_id = $request["post_id"];
                $store->user_id = $this->_user->getAuthIdentifier();
                $store->is_favorite = true;
                $store->saveOrFail();
            } else {
                $exists->is_favorite = !$exists->is_favorite;
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
