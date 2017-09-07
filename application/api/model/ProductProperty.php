<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/17
 * Time: 0:03
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = [
        'product_id', 'delete_time',
        'id', 'update_time',
    ];
}