<?php

namespace App\Http\Controllers;

use App\ValueObject\MyResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $func
     * @param string $name
     * @param string $mes
     * @return MyResponse
     */
    protected function withTransaction($func, $name = "", $mes = "")
    {

        try {

            DB::beginTransaction();

            $func();

            DB::commit();

            return MyResponse::withMessage(
                200,
                "完了しました。"
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return MyResponse::withMessage(
                500,
                "エラーが発生しました。"
            );
        }

    }
}
