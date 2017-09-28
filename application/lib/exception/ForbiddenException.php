<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/19
 * Time: 23:36
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code =403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}