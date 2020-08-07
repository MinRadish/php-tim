<?php
/**
 * 单聊消息
 * @authors Radish (minradish@163.com)
 * @date    2020-08-06 10:30 Thursday
 */

namespace Radish\Tim\Handle;

use Radish\Tim\Tim;

class SingleChat implements \Radish\Tim\RequestBusinessInterface 
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
     * 批量发单聊消息
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function batchSendMsg(array $params)
    {
        return $this->commnoRequest('batch_send_msg', $params);
    }

    /**
     * 用户相关接口地址
     * @param  string $key 接口
     * @return string      接口地址
     */
    public function getApiUrl($key)
    {
        $map = [
            'batch_send_msg' => 'v4/openim/batchsendmsg'
        ];
        return $this->url . $map[$key];
    }

    /**
     * 错误码
     * @param  int $code 错误码
     * @return string    错误说明
     */
    public function getCodeMap($code)
    {
        $map = [
            '20001' => '请求包非法',
            '20002' => 'UserSig 或 A2 失效',
            '20003' => '消息发送方或接收方 UserID 无效或不存在，请检查 UserID 是否已导入即时通信 IM',
            '20004' => '网络异常，请重试',
            '20005' => '服务器内部错误，请重试',
            '20006' => '触发发送单聊消息之前回调，App 后台返回禁止下发该消息',
            '90001' => 'JSON 格式解析失败，请检查请求包是否符合 JSON 规范',
            '90002' => 'JSON 格式请求包中 MsgBody 不符合消息格式描述，或者 MsgBody 不是 Array 类型，请参考 TIMMsgElement 对象 的定义',
            '90003' => 'JSON 格式请求包体中缺少 To_Account 字段或者 To_Account 字段不是 String 类型',
            '90005' => 'JSON 格式请求包体中缺少 MsgRandom 字段或者 MsgRandom 字段不是 Integer 类型',
            '90006' => 'JSON 格式请求包体中 MsgTimeStamp 字段不是 Integer 类型',
            '90007' => 'JSON 格式请求包体中 MsgBody 类型不是 Array 类型，请将其修改为 Array 类型',
            '90009' => '请求需要 App 管理员权限',
            '90010' => 'JSON 格式请求包不符合消息格式描述，请参考 TIMMsgElement 对象 的定义',
            '90012' => 'To_Account 没有注册或不存在，请确认 To_Account 是否导入即时通信 IM 或者是否拼写错误',
            '90026' => '消息离线存储时间错误（最多不能超过7天）',
            '90031' => 'JSON 格式请求包体中 SyncOtherMachine 字段不是 Integer 类型',
            '90044' => 'JSON 格式请求包体中 MsgLifeTime 字段不是 Integer 类型',
            '91000' => '服务内部错误，请重试',
            '90992' => '服务内部错误，请重试；如果所有请求都返回该错误码，且 App 配置了第三方回调，请检查 App 服务器是否正常向即时通信 IM 后台服务器返回回调结果',
            '93000' => 'JSON 数据包超长，消息包体请不要超过 8k',
            '90048' => '请求的用户帐号不存在',
        ];
        if (isset($map[$code])) {
            $map = $map[$code];
        } else {
            $map = '未知错误！';
        }

        return $map;
    }
}