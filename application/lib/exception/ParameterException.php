<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/9
 * Time: 22:33
 */

namespace app\lib\exception;


use think\Exception;

class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}