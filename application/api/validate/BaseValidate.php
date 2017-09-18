<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/2
 * Time: 17:20
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取HTTP 传入参数
        //对这些参数做校验
        //获取传入的全部参数
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if(!$result)
        {
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;
        }
        else
        {
            return true;
        }
    }

    /**
     * 判断是否是正整数
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     */
    protected function isPositiveInteger($value,$rule = '', $data = '',$field = '' )
    {
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0)
        {
            return true;
        }
        else{
            return false;
//            return $field.'必须为正整数';
        }
    }

    /**
     * 判断是否是电话号码
     * @param $value
     * @return bool
     */
    protected function isMobile($value)
    {
        $rule = "^1(3|4|5|6|7|8)[0-9]\d{8}$^";
        $result = preg_match($rule, $value);
        if($result)
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断是否为空
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     */
    protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
    {
        if(empty($value))
        {
            return false;
        }else{
            return true;
        }
    }

    /**
     * 获取验证的所有值
     * @param $arrays
     * @return array
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if(array_key_exists("user_id", $arrays) |
        array_key_exists("uid", $arrays))
        {
            //不允许包含user_id 或者uid，防止恶意覆盖user_id外键
            throw new ParameterException([
                "msg" => "参数中包含有非法的参数名user_id或者uid"
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value)
        {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}