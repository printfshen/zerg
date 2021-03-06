<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/2
 * Time: 21:23
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories()
    {
        $categories = CategoryModel::all([],'img');
        if($categories->isEmpty())
        {
            throw new CategoryException();
        }
        return $categories;
    }
}