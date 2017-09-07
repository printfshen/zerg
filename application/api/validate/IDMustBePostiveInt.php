<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/2
 * Time: 12:01
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id' => 'id必须为正整数',
    ];


}