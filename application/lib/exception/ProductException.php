<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/29
 * Time: 1:31
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    protected $code = 404;
    protected $msg = '指定的商品不存在，请检查参数';
    protected $errorCode = 20000;
}