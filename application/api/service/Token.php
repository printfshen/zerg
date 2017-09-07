<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/15
 * Time: 22:28
 */

namespace app\api\service;


class Token
{
    public static function generateToken()
    {
        //32个字符组成一组随机的字符串
        $randChars = getRandChar(32);
        //用三组字符串，进行MD5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt 盐
        $salt = config('secure.token_salt');
        return md5($randChars . $timestamp . $salt);
    }

}