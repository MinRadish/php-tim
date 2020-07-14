<?php
/**
 * 群组接口
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-07 16:14 Tuesday
 */

namespace Radish\Tim\Handle;

use Radish\Tim\Tim;

class Group implements \Radish\Tim\RequestBusinessInterface
{
    use \Radish\Tim\Traits\RequestTrait;

    /**
     * Tim
     * @var object
     */
    public $tim;

    public function __construct(Tim $tim)
    {
        $this->tim = $tim;
    }

    /**
     * 创建群聊
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function create(array $params)
    {
        return $this->commnoRequest('create_group', $params);
    }

    /**
     * 修改群基础资料
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function update(array $params)
    {
        return $this->commnoRequest('modify_group_base_info', $params);
    }

    /**
     * 增加群成员
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function join(array $params)
    {
        return $this->commnoRequest('add_group_member', $params);
    }

    /**
     * 踢出群成员
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function quit(array $params)
    {
        return $this->commnoRequest('delete_group_member', $params);
    }

    /**
     * 修改群成员信息
     * @param  array  $params 请求参数
     * @return array|mixed    响应结果
     */
    public function updateUser(array $params)
    {
        return $this->commnoRequest('modify_group_member_info', $params);
    }

    /**
     * 用户相关接口地址
     * @param  string $key 接口
     * @return string      接口地址
     */
    public function getApiUrl($key)
    {
        $map = [
            'create_group' => 'v4/group_open_http_svc/create_group',
            'modify_group_base_info' => 'v4/group_open_http_svc/modify_group_base_info',
            'add_group_member' => 'v4/group_open_http_svc/add_group_member',
            'delete_group_member' => 'v4/group_open_http_svc/delete_group_member',
            'modify_group_member_info' => 'v4/group_open_http_svc/modify_group_member_info',
        ];
        return $this->tim->getUrl() . $map[$key];
    }

    public function getCodeMap($code)
    {
        $map = [
            '10002' => '服务器内部错误，请重试',
            '10003' => '请求命令字非法',
            '10004' => '参数非法，请根据错误描述检查请求是否正确',
            '10005' => '请求包中导入的成员数量超过500，请减少MemberList参数中导入的成员数量',
            '10006' => '创建群数量超过限额，例如累计创建在线成员广播大群（BChatRoom）超过5个，或者每日净增群组数超过配置的限额。详情请参考 群组限制差异',
            '10007' => '操作权限不足，请根据错误信息检查请求参数。例如，指定的群组类型不允许拉人入群，但在请求包中填写了MemberList',
            '10008' => '请求非法，可能是请求中携带的签名信息验证不正确，请再次尝试或 提交工单 联系技术客服',
            '10016' => 'App 后台通过第三方回调拒绝本次操作，请检查您的回调服务“创建群组之前回调”的返回值',
            '10021' => '群组 ID 已被其他人使用，请选择其他的群组 ID',
            '10025' => '该群组 ID 已经由您自己使用过，请您先解散该群组或者选择其他的群组 ID',
            '10036' => '创建的音视频聊天室数量超过限制，请先解散部分音视频聊天室或者参考 价格说明 购买升级',
            '10037' => '请求中指定了群主（Owner_Account），但该群主创建和加入的群组数量超过了限制。请该群主退出部分群组或者参考 价格说明 购买升级',
            '10038' => '请求包中导入的成员数量超过了限制，请减少MemberList参数中导入的成员数量或者参考 价格说明 购买升级',
            '80001' => '文本安全打击，请检查群名称、群公告和群简介等是否有敏感词汇',
        ];
        if (isset($map[$code])) {
            $map = $map[$code];
        } else {
            $map = '未知错误！';
        }

        return $map;
    }
}