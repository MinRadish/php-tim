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
        'GroupId' => 'GroupId', //必须
        'Name' => 'Name',
        'Introduction' => 'Introduction',
        'Notification' => 'Notification',
        'FaceUrl' => 'FaceUrl',
    ],
];
$result = $tim->getGroup()->update($params);
~~~

### 增加群成员

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'GroupId' => 'id',
        'Silence' => 1,
        'MemberList' => [
            ['Member_Account' => 'id'],
        ],
    ],
];
$result = $tim->getGroup()->join($params);
~~~

### 踢出群成员

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'GroupId' => 'group_id',
        'Silence' => 1,
        'MemberToDel_Account' => [
            'user_id',
        ],
    ],
];
$result = $tim->getGroup()->quit($params);
~~~

### 修改群成员信息

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig('Radish'),
    'params' => [
        'GroupId' => 'group_id',
        'Member_Account' => 'user_id',
        'NameCard' => 'group_nickname',
    ],
];
$result = $tim->getGroup()->updateUser($params);
~~~