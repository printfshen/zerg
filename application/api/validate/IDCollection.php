<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/26
 * Time: 23:37
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    /**
     * 验证器规则
     * @var array
     */
    protected $rule = [
        'ids' => 'require|checkIDs',
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分隔的多个正整数',
    ];

    /**
     * 自定义验证器
     * @param $value get传过来的值 ids = id1，id2...
     *
     */
    protected function checkIDs($value)
    {
        $values = explode(',',$value);
        if(empty($values))
        {
            return false;
        }
        foreach($values as $id)
        {
            if(!$this->isPositiveInteger($id))
            {
                return false;
            }
        }
        return true;
    }
}