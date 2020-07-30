<?php
/**
 * 腾讯即时通讯服务端接口调用
 * @authors Radish (1004622952@qq.com)
 * @date    2020-07-06 10:14 Monday
 */

namespace Radish\Tim;

use Radish\Tim\Handle\User;
use Radish\Tim\Handle\Group;
use Radish\Tim\Handle\UserSig;

abstract class Tim
{
    /**
     * SDKAppID
     * @var string
     */
    protected $sdkAppId = '';
    /**
     * 秘钥
     * @var string
     */
    protected $key = '';

    /**
     * 接口地址
     * @var string
     */
    protected $url = '';

    /**
     * UserSig
     * @var object
     */
    protected $userSig;

    /**
     * User
     * @var object
     */
    protected $user;

    /**
     * group
     * @var object
     */
    protected $group;

    /**
     * App 管理员帐号
     * @var string
     */
    protected $identifier = 'administrator';

    public function __construct(array $options)
    {
        foreach ($options as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * 获取UserSig
     * @return object UserSig;
     */
    public function getUserSig()
    {
        if (!$this->userSig) {
            $this->userSig = new UserSig($this->sdkAppId, $this->key);
        }
        return $this->userSig;
    }

    /**
     * 获取User
     * @return object User\User
     */
    public function getUser()
    {
        if (!$this->user) {
            $this->user = new User($this);
        }
        return $this->user;
    }

    /**
     * 获取Group
     * @return object Group\Group
     */
    public function getGroup()
    {
        if (!$this->group) {
            $this->group = new Group($this);
        }
        return $this->group;
    }

    /**
     * 获取sdkAppId
     * @return string sdkAppId
     */
    public function getAppId() : string
    {
        return $this->sdkAppId;
    }

    /**
     * 获取Key
     * @return string key
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * 获取Url配置项
     * @return string url
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * 获取app管理员账号
     * @return string App管理员账号
     */
    public function getIdentifier() : string
    {
        return $this->identifier;
    }
}