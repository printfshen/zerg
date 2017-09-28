<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/28
 * Time: 7:55
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    //订单的商品列表，也就是客户端传递过来的Products参数
    protected $oProducts;
    //数据库查询出来的商品信息
    protected $products;

    protected $uid;

    public function place($uid, $oProducts)
    {
        //oProducts 和 Products 做对比
        //Products 从数据库里面查询出来
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
    }

    /**
     * 根据订单信息查找真实的商品信息
     * @param $oProducts
     * @return mixed
     */
    private function getProductsByOrder($oProducts)
    {
        //先循环把ID取出
        $oPIDs = [];
        foreach ($oProducts as $item)
        {
            array_push($oPIDs,$item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible(['id', 'price', 'stock',
                'name', 'main_img_url'])
            ->toArray();
        return $products;
    }
}