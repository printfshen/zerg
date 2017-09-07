<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/6
 * Time: 1:27
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }
}