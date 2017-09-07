<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/15
 * Time: 23:01
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或者无效Token';
    public $errorCode = 10001;
}