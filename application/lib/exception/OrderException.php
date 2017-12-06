<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/28
 * Time: 23:20
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}