<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/28
 * Time: 7:55
 */

namespace app\api\service;


use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Exception;

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
        $status = $this->getOrderStatus();
        if(!$status['pass'])
        {
            $status['order_id'] = -1;
            return $status;
        }
        //开始创建订单
        $orderSnap = $this->snapOrder($status);


    }


    private function createOrder($snap)
    {
        try {
            $orderNo = self::makeOrderNo();
            $order = new \app\api\model\Order();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['orderCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->save();

            $orderID = $order->id;
            $create_time = $order->create_time;
            foreach ($this->oProducts as &$p) {
                $p['order_id'] = $orderID;
            }
            $orderProduct = new  OrderProduct();
            $orderProduct->saveAll($this->oProducts);

            return [
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time
            ];
        } catch (Exception $ex)
        {
            throw $ex;
        }
    }

    /**
     * 获取订单编号
     * @return string
     */
    public static function makeOrderNo()
    {
        $yCode = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");
        $orderSn = $yCode[intval(date("Y"))-2017]
            . strtoupper(dechex(date("m")))
            . date("d") . substr(time(),2, 5)
            .sprintf("%02d", rand(0,99));
        return $orderSn;
    }

    /**
     * 开始生成订单快照
     */
    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => '',
        ];
        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];
        if(count($this->products) > 1)
        {
            $snap['snapName'] += count($this->products) . '等';
        }
    }

    /**
     * 获取收货地址
     * @return array
     * @throws UserException
     */
    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id', '=', $this->uid)
            ->find();
        if(!$userAddress)
        {
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errorCode' => 60001,
            ]);
        }
        return $userAddress->toArray();
    }


    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatusArray'=>[],
        ];

        foreach ($this->oProducts as $oProduct)
        {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'],
                $this->products
            );
            if(!$pStatus['haveStock'])
            {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice']; // 总价格
            $status['totalCount'] += $pStatus['count']; // 总数量
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($opID, $oCount, $products)
    {
        $pIndex = -1;

        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalPrice' => 0,
        ];

        for ($i=0; $i<count($products); $i++)
        {
            if($opID == $products[$i]['id'])
            {
                $pIndex = $i;
            }
        }
        //客户端传递的product_id有可能不存在
        if($pIndex == -1)
        {
            throw new OrderException([
                'msg' => 'id为'.$opID.'商品不存在，创建订单失败',
            ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if(($product['stock'] - $oCount) >= 0)
            {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
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