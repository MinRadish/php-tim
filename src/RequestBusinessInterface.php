<?php
/**
 * 
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-06 18:33 Monday
 */

namespace Radish\Tim;

interface RequestBusinessInterface
{
    /**
     * 获取接口地址
     * @param  string $key 接口类型
     * @return string      接口地址
     */
    public function getApiUrl($key);
    /**
     * 响应错误码映射
     * @param  string $code 错误码
     * @return string       错误信息
     */
    public function getCodeMap($code);
}