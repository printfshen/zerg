<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/2
 * Time: 23:57
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '制定类目不存在，请检查参数';
    public $errorCode = 50000;
}