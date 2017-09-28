<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/21
 * Time: 23:03
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenService;

class Order extends BaseController
{
    //用户在选择商品后，想API提交商品的相关信息
    //API在接收到信息后，需要检查订单相关商品的库存
    //调用我们的支付接口，进行支付
    //还需要再次进行库存量检测
    //服务器这边就可以调用支付接口进行支付
    //微信会返回给我们一个支付结果（异步）
    //成功：也需要进行库存量的检测
    //成功：进行哭出来的扣除，
    //失败：返回一个支付失败结果

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
    ];

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

    }
}