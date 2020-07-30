<?php
/**
 * 请求接口特性
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-06 18:20 Monday
 */

namespace Radish\Tim\Traits;

use Radish\Network\Curl;
use Radish\Tim\Exception\TimException;

trait RequestTrait
{
    /**
     * Curl 请求接口
     * @param  string $url     请求地址
     * @param  array  $params  请求参数
     * @param  array  $options Curl配置
     * @param  string $method  请求类型
     * @return array|mixed     请求结果
     */
    protected function request($url, $params = [], $options = [], $method = 'post')
    {
        if ($method == 'post' || $method == 'put') {
            // dum([$url, $params]);
            $result = Curl::$method($url, $params, $options);
        } else if ($method == 'get' || $method == 'delete') {
            $result = Curl::$method($url . '?' . http_build_query($params), $options);
        } else {
            throw new \Exception("Error Processing Request", 1);
        }

        return $this->getMessage($result, '请求接口失败');
    }

    /**
     * 处理响应结果
     * @param  json|mixed $result  响应结果 
     * @param  string $message     错误提醒
     * @return array|mixed         响应结果
     */
    protected function getMessage($result, $message = '未知错误！')
    {
        $resultArray = json_decode($result, true);
        if (isset($resultArray['ErrorCode']) && $resultArray['ErrorCode'] != 0) {
            $meg = $resultArray['ErrorInfo'] ?? $message;
            throw new TimException($meg, $result);
        } else {
            return $resultArray;
        }
    }

    /**
     * 公共请求用户相关接口
     * @param  string $urlKey 接口Key
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function commnoRequest(string $urlKey, array $params)
    {
        $params = $this->formatParams($params);
        $param = $params['params'] ?? [];
        unset($params['params']);
        $url = $this->getApiUrl($urlKey) . '?' . http_build_query($params);
        $options = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ];

        return $this->request($url, json_encode($param, JSON_UNESCAPED_UNICODE), $options);
    }

    /**
     * 处理公共请求参数
     * @param  array  $params 自定义参数
     * @return array          处理后的参数
     */
    protected function formatParams(array $params)
    {
        list($usec, $sec) = explode(" ", microtime());
        $random = (float)$usec + (float)$sec;
        $params = array_merge([
            'sdkappid' => $this->tim->getAppId(),
            'identifier' => $this->tim->getIdentifier(),
            'random' => substr($random * 10000, -9),
            'contenttype' => 'json',
        ], $params);

        return $params;
    }
}