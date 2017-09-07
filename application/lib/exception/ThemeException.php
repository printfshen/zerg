<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/27
 * Time: 23:32
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}