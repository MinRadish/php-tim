<?php
/**
 * 错误处理类
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-07 09:49 Tuesday
 */

namespace Radish\Tim\Exception;

class TimException extends \Exception
{
    /**
     * 错误信息
     * @var string
     */
    protected $message;

    /**
     * 响应结果
     * @var json|mixed
     */
    protected $result;

    /**
     * 日志文件名
     * @var string
     */
    public $fileName = 'Tim.log';

    public function __construct($message, $result)
    {
        $this->message = $message;
        $this->result = $result;
        $this->createLog();
    }

    /**
     * 创建日志
     */
    protected function createLog()
    {
        $path = $this->getPath();
        if (is_dir($path)) {
            $file = $path . DIRECTORY_SEPARATOR . 'Tim.log';
            $time = date('Y-m-d H:i:s');
            file_put_contents($file, 
                $time . PHP_EOL . 
                'result:' . $this->result() . PHP_EOL . 
                'message:' . $this->message . PHP_EOL
            , FILE_APPEND);
        }
    }

    /**
     * 获取保存日志路径
     * @return string 路径
     */
    protected function getPath()
    {
        if (PHP_SAPI == 'cli') {
            $path = $_SERVER['PWD'];
            if (PHP_OS == 'WINNT') {
                preg_match('/^\/(\w+\/?)/', $path, $array);
                if (count($array) >= 2) {
                    $dir = trim($array[1], '\/') . ':';
                    $path = $dir . substr($path, strlen($array[0]) - 1);
                }
            }
        } else {
            $path = $_SERVER['DOCUMENT_ROOT'];
        }

        return $path;
    }

    /**
     * 获取错误信息
     * @return string 错误信息
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * 获取接口响应数据
     * @return json|mixed 响应数据
     */
    public function result()
    {
        return $this->result;
    }
}