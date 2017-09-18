<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/14
 * Time: 23:51
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = [
        'id', 'delete_time', 'use_id',
    ];
}