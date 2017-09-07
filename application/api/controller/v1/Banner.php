<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/6/30
 * Time: 0:02
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePostiveInt;
use app\api\validate\TestValidate;
use app\lib\exception\BannerMissException;
use think\Exception;
use think\Validate;
use app\api\model\Banner as BannerModel;
class Banner
{
    /**
     * 获取指定ID的banner信息
     * @url /banner/:id
     * @http GET
     * @param $id banner的ID号
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();

//        $banner = BannerModel::with(['items','items.img'])->find($id);
//        $banner = BannerModel::with(['模型层定义','模型层定义名称'])-find($id);
        $banner = BannerModel::getBannerById($id);
//            ->hidden(['delete_time','update_time']);
//隐藏  某些字段 hidden  显示某些字段 visible
        $aa = $banner->toArray();
        print_r($aa);exit;
        if($banner->isEmpty())
        {
            throw new BannerMissException();
        }
        return $banner;
    }

}