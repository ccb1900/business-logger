# 业务日志记录

## 继承 OperationLogUtil
```php
class OperationLoggerService extends OperationLogUtil
{
    public function __construct()
    {
        // 此处配置可以按照自己的情况获取
        $config = [
            'app_name' => '日志记录仪',
            'map' => [
                '模型名称' => [
                    // 数据库字段处理方式
                    'name' => [
                        'alias' => '流程名称',
                        'type' => \BusinessLogger\Handler\NormalTypeHandler::class,
                    ],
                    'description' => [
                        'alias' => '描述',
                        'type' => \BusinessLogger\Handler\RichTextTypeHandler::class,
                    ],
                    'desc' => [
                        'alias' => '描述',
                        'type' => \BusinessLogger\Handler\NormalTypeHandler::class,
                    ],
                ]
            ],
        ];
        parent::__construct([]);
    }
    protected function save(array $operation, array $attributes)
    {
        $operation = Operation::create($operation);

        foreach ($attributes as &$item) {
            $item['operation_id'] = $operation->id;
        }
        OperationAttribute::insertAll($attributes);
    }
}
```
上面的写法是为了兼容不同的框架

## 配置文件结构
```php
return [
    'app_name' => '日志记录仪',
    'map' => [
        'sddjdsdh' => [
            'name' => [
                'alias' => '流程名称',
                'type' => \BusinessLogger\Handler\NormalTypeHandler::class,
            ],
            'description' => [
                'alias' => '描述',
                'type' => \BusinessLogger\Handler\RichTextTypeHandler::class,
            ],
            'desc' => [
                'alias' => '描述',
                'type' => \BusinessLogger\Handler\NormalTypeHandler::class,
            ],
        ]
    ],
];
```

## 特殊类型处理接口

可以实现`BaseExtendedTypeHandler`接口，自定义处理方式
