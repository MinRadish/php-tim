# 单聊消息

- [腾讯云文档地址](https://cloud.tencent.com/document/product/269/2282)

### 批量发单聊消息

**示例代码**

~~~
$tim = new Tim;
$params = [
    'usersig' => $tim->getUserSig()->genSig($tim->getIdentifier()),
    'params' => [
        'SyncOtherMachine' => 2, //若不希望将消息同步至 From_Account，则 SyncOtherMachine 填写2。若希望将消息同步至 From_Account，则 SyncOtherMachine 填写1。
        'From_Account' => (string) $this->user_id,
        'To_Account' => $toAccount,
        'MsgRandom' => mt_rand(),
        'MsgBody' => [
            [
                'MsgType' => 'TIMTextElem',
                'MsgContent' => [
                    'Text' => '我发布了一个composer包，欢迎前来围观！'
                ],
            ],
        ],
    ],
];
$result = $tim->getSingleChat()->batchSendMsg($params);
~~~