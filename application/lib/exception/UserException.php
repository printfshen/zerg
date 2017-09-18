<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/14
 * Time: 21:12
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}