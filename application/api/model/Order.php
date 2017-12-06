<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/12/6
 * Time: 22:46
 */

namespace app\api\model;


use app\api\controller\BaseController;

class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
}