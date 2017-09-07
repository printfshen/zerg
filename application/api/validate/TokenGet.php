<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/6
 * Time: 1:05
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];

    protected $message = [
        'code' => '没有code还想获取Token，做梦哦！',
    ];


}