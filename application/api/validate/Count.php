<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/29
 * Time: 1:05
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];

}