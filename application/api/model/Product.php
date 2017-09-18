<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/26
 * Time: 22:36
 */

namespace app\api\model;

class Product extends BaseModel
{
    protected $hidden = [
        'delete_time','main_img_id','pivot','from'
        ,'update_time','create_time','category_id',
    ];

    protected function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::where('category_id', '=', $categoryID)
            ->select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        //重点查询排序在 其他表里面
        $product = self::with([
            'imgs' => function($query){
                $query->with(['imgUrl'])
                    ->order('order','asc');
            }
        ])
            ->with(['properties'])
            ->find($id);
        return $product;
    }
}