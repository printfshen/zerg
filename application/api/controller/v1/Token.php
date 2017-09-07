<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/8/6
 * Time: 0:58
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code='')
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
          'token' => $token,
        ];
    }
}