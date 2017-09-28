<?php
/**
 * Created by PhpStorm.
 * User: 沈枫山
 * Date: 2017/9/26
 * Time: 23:37
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{

    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    protected function  checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}