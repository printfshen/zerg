<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/2
 * Time: 11:36
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule = ([
        'name' => 'require|max:10',
        'email' => 'email',
    ]);
}