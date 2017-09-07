<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/5
 * Time: 23:23
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    protected $hidden = ['id', 'delete_time', 'update_time'];
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])
            ->find($id);
        return $banner;
//        $result = Db::query(
//            'select * from banner_item where banner_id=?',[$id]
//        );
//        return $result;
//        $result = DB::table('banner_item')
//            ->where('banner_id', '=', $id)
//            ->select();
//        return $result;
        //表达式  数组法（安全性有问题） 闭包
        //闭包写法
//        $result = Db::table('banner_item')
//            ->where(function ($query) use ($id){
//                $query->where('banner_id','=',$id);
//            })
//            ->select();
//        return $result;
    }
}