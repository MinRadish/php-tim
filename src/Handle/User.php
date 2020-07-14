<?php
/**
 * 用户相关
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-06 18:14 Monday
 */

namespace Radish\Tim\Handle;

use Radish\Tim\Tim;

class User implements \Radish\Tim\RequestBusinessInterface
{
    use \Radish\Tim\Traits\RequestTrait;

    /**
     * 接口地址
     * @var string
     */
    protected $url;

    /**
     * Tim
     * @var object
     */
    public $tim;

    public function __construct(Tim $tim)
    {
        $this->tim = $tim;
        $this->url = $tim->getUrl();
    }

    /**
     * 导入单个用户
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function import(array $params)
    {
        return $this->commnoRequest('account_import', $params);
    }

    /**
     * 查询账号 
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function check(array $params)
    {
        return $this->commnoRequest('account_check', $params);
    }

    /**
     * 查询帐号在线状态
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function queryState(array $params)
    {
        return $this->commnoRequest('querystate', $params);
    }

    /**
     * 设置资料
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function setInfo(array $params)
    {
        return $this->commnoRequest('portrait_set', $params);
    }

    /**
     * 用户相关接口地址
     * @param  string $key 接口
     * @return string      接口地址
     */
    public function getApiUrl($key)
    {
        $map = [
            'account_import' => 'v4/im_open_login_svc/account_import',
            'account_check' => 'v4/im_open_login_svc/account_check',
            'querystate' => 'v4/openim/querystate',
            'portrait_set' => 'v4/profile/portrait_set',
        ];
        return $this->url . $map[$key];
    }

    public function getCodeMap($code)
    {
        $map = [
            '40005' => '资料字段中包含敏感词',
            '40006' => '设置资料时服务器内部错误，请稍后重试',
            '40601' => '资料字段的 Value 长度超过500字节',
            '70169' => '服务端内部超时，请稍后重试',
            '70398' => '帐号数超限。如需创建多于100个帐号，请将应用升级为专业版，具体操作指引请参见 购买指引',
            '70402' => '参数非法，请检查必填字段是否填充，或者字段的填充是否满足协议要求',
            '70403' => '请求失败，需要 App 管理员权限',
            '70500' => '服务器内部错误，请稍后重试',
        ];
        if (isset($map[$code])) {
            $map = $map[$code];
        } else {
            $map = '未知错误！';
        }

        return $map;
    }
}