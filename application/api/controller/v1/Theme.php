<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/26
 * Time: 22:36
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;
use think\Exception;

class Theme
{
    /**
     * 主题信息
     * @URL /theme?ids = id1，id2....
     * @HTTP get
     * @return 一组theme 模型
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return $result;
    }

    /**
     * @url /Theme/:id
     *
     */
    public function getComplexOne($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if(!$theme){
            throw new ThemeException();
        }
        return $theme;
    }


}