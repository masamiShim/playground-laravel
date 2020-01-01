<?php

namespace App\Http\Controllers;

use App\ValueObject\MyResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $_user;

    public function __construct()
    {
        $this->_user = Auth::user();
    }


    /**
     * @param $func
     * @param bool $notify
     * @param string $name
     * @param string $mes
     * @return array
     */
    protected function withTransaction($func, $notify = true, $name = "", $mes = "")
    {

        try {

            DB::beginTransaction();

            $func();

            DB::commit();

            return MyResponse::withMessage(
                200,
                $notify ? "完了しました。" : null
            )->toArray();

        } catch
        (\Exception $e) {

            DB::rollBack();

            return MyResponse::withMessage(
                500,
                "エラーが発生しました。\n {$e->getMessage()}"
            )->toArray();
        }

    }

    /**
     * @param $func
     * @param string $name
     * @param string $mes
     * @return array
     */
    protected function withTransactionNotNotify($func, $name = "", $mes = "")
    {

        return $this->withTransaction($func, false, $name, $mes);

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

    protected function setAudit($model)
    {
        if (!is_null($model['created_by'])) {
            $model->created_by = $this->_user->getAuthIdentifier();
        }
        if (!is_null($model['updated_by'])) {
            $model->updated_by = $this->_user->getAuthIdentifier();
        }
    }
}
