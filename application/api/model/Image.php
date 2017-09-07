<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    //隐藏字段 $hidden  显示字段 $visible
    protected $hidden = ['id', 'from', 'delete_time', 'update_time'];

    //读取器
    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }
}
