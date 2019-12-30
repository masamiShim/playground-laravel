<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    function login(Request $request)
    {

        // リクエストから認証に必要な情報を取得する。
        $credentials = request(['email', 'password']);
        // authを使ってトークンを取得する。
        if (!$token = auth('api')->attempt($credentials)) {
            // 取得できない場合
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * ログアウト
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'ログアウトしました。']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            "access_token" => $token,
            "token_type" => 'bearer',
            "expires_in" => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
