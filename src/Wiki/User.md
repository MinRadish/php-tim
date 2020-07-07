# 用户相关操作

- [腾讯云文档地址](https://cloud.tencent.com/document/product/269/1608)

### 导入单个用户

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'Identifier' => (string)$this->getAttribute('id'),
        'Nick' => $this->getAttribute('wechat.nickname'),
        'FaceUrl' => $this->getAttribute('wechat.headimgurl'),
    ],
];
$result = $tim->getUser()->import($params);
~~~

**参数说明**

- 导入单个用户参数说明

|参数|是否必须|说明|
|:--|:--|:--|
|usersig|是|对应管理员的UserSig|
|params|是|请求包信息|
|sdkappid|否|默认加载实例化配置信息|
|identifier|否|App 管理员帐号(默认`Radish`)|
|random|否|请输入随机的32位无符号整数。(默认`毫秒级时间戳后9位`)|
|params.Identifier|是|用户名，长度不超过32字节|
|params.Nick|否|用户昵称|
|params.FaceUrl|否|用户头像 URL|

### 查询帐号

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'CheckItem' => [
            ['UserID' => '1']
        ],
    ],
];
dum($tim->getUser()->check($params));
~~~

**参数说明**

- see [查询帐号](https://cloud.tencent.com/document/product/269/38417)

### 查询在线状态

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'IsNeedDetail' => 1, //选填,是否需要返回详细的登录平台信息。0表示不需要，1表示需要
        'To_Account' => ['1']
    ],
];
dum($tim->getUser()->queryState($params));
~~~

**参数说明**

- see [查询在线状态](https://cloud.tencent.com/document/product/269/2566)