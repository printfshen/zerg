<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/10
 * Time: 22:35
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;

}