<?php
/**
 * BaseModel 自定义模型基类Model
 */
namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //拼接图片URL
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] == 1)
        {
            $finalUrl = config('setting.img_prefix') . $value;
        }
        return $finalUrl;
    }
}
