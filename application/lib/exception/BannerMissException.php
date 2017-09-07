<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/9
 * Time: 17:15
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banner不存在';
    public $errorCode = 40000;
}