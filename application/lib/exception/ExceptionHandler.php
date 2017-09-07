<?php
/**
 * Created by PhpStorm.
 * User: shenfengshan
 * Date: 2017/7/9
 * Time: 17:03
 */

namespace app\lib\exception;


use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    //需要返回客户端当前请求的URL 路径
    public function render(\Exception $e)
    {
        if($e instanceof  BaseException)
        {
            //果然是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else
        {
            //开关 是否用TP5 的日志  获取配置文件里面的 参数值
//            config::get('app_debug'); //助手函数
            if(config('app_debug'))
            {
                return parent::render($e);

            }else{
                $this->code = 500;
                $this->msg = '服务器内部错误，不想告诉你！';
                $this->errorCode = 999;
            }
        }
        $request = Request::instance();

        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url(),
        ];
        $this->recordErrorLog($e);
        return json($result,$this->code);
    }

    private function recordErrorLog(\Exception $e)
    {
        //初始化日志
        log::init([
           'type' => 'file',
            'path' => LOG_PATH,
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(),'error');
    }
}