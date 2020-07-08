# 群聊相关

- [腾讯云文档地址](https://cloud.tencent.com/document/product/269/1615)

### 创建群聊

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'Owner_Account' => (string) $this->getAttribute('make_user_id'),
        'Type' => 'Public',
        'GroupId' => $this->id,
        'Name' => $this->getAttribute('name'),
        'Introduction' => $this->getAttribute('synopsis'),
        'Notification' => $this->getAttribute('notice'),
        'FaceUrl' => $this->getAttribute('face'),
        'MaxMemberCount' => 500, // 最大群成员数量（选填）
        'ApplyJoinOption' => 'FreeAccess',
        'MemberList' => [
            ['Member_Account' => (string) $this->getAttribute('make_user_id')],
        ],
    ],
];
$result = $tim->getGroup()->create($params);
~~~

### 更新群聊基本信息

- [腾讯云文档地址](https://cloud.tencent.com/document/product/269/1620)

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'GroupId' => $id,
    ],
];
$data = $this->getData();
foreach ($data as $key => $val) {
    switch ($key) {
        case 'name':
            $params['params']['Name'] = $val;
            break;
        
        case 'synopsis':
            $params['params']['Introduction'] = $val;
            break;
        
        case 'notice':
            $params['params']['Notification'] = $val;
            break;
        
        case 'face':
            $params['params']['FaceUrl'] = $val;
            break;
        
        default:
            // throw new \Exception("nothing to do", -1);
            break;
    }
}
$result = $tim->getGroup()->update($params);
~~~