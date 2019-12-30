<?php


namespace App\ValueObject;

/**
 * Class MyResponse
 * @package App\ValueObject
 */
class MyResponse
{
    private $status;
    private $content;
    private $message;

    /**
     * @deprecated 基本コンストラクタを外部から呼ぶ必要ないので直接利用しないでね。
     * MyResponse constructor.
     * @param $status
     * @param $content
     * @param $message
     */
    private function __construct($status, $content, $message)
    {
        $this->status = $status;
        $this->content = $content;
        $this->message = $message;
    }

    /**
     * まぁstatusは必須だよね。
     * @param $status
     * @return MyResponse
     */
    public static function onlyStatus($status)
    {
        return new MyResponse($status, null, null);
    }

    public static function withContent($status, $content)
    {
        return new MyResponse($status, $content, null);
    }

    public static function withMessage($status, $message)
    {
        return new MyResponse($status, null, $message);
    }

    public function toArray() {
        return [
            "status" => $this->status,
            "content" => $this->content,
            "message" => $this->message
        ];
    }

}
