<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/13
 * Time: 21:51
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
      'name' => 'require|isNotEmpty',
      'mobile' => 'require|isMobile',
      'province' => 'require|isNotEmpty',
      'city' => 'require|isNotEmpty',
      'country' => 'require|isNotEmpty',
      'detail' => 'require|isNotEmpty',
    ];
}