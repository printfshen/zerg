<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/16
 * Time: 23:58
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = [
        'img_id', 'delete_time', 'product_id',
    ];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}