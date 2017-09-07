<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/2
 * Time: 21:36
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = [
        'topic_img_id','delete_time',
        'description','update_time',
    ];

    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }
}