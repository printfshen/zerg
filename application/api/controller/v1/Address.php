<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/13
 * Time: 20:04
 */

namespace app\api\controller\v1;


use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;

class Address
{

    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();
        //根据Token来获取uid
        //根据uid来查找用户数据，判断用户是否存在，如果不存在抛出异常
        //获取用户从客户端提交来的信息
        //根据用户地址信息是否存在从而判断是添加地址还是更新地址
        $uid =TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user)
        {
            throw new UserException();
        }
        //获取表单提交
        $dataArray = $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;
        if(!$userAddress)
        {
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(), 201);
    }

}