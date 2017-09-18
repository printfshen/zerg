<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/14
 * Time: 21:29
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = "OK";
    public $errorCode = 0;
}