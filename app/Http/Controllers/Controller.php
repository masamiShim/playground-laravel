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
     * @return array
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
            )->toArray();

        } catch (\Exception $e) {

            DB::rollBack();

            return MyResponse::withMessage(
                500,
                "エラーが発生しました。\n {$e->getMessage()}"
            )->toArray();
        }

    }

    /**
     * @param $result
     * @return array
     */
    protected function queryResult($result)
    {
        try {

            return MyResponse::withContent(
                200,
                $result
            )->toArray();
        } catch (\Exception $e) {
            return MyResponse::withMessage(
                500,
                "エラーが発生しました。\n {$e->getMessage()}"
            )->toArray();
        }
    }
}
