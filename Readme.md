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
            // 默认驱动就是tp
            'driver' => \BusinessLogger\Driver\ThinkPHP\ThinkPHP::class,
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
        parent::__construct($config);
    }
}
```

可兼容不同框架

## 配置文件结构
```php
return [
    // 应用名称
    'app_name' => '日志记录仪',
    // 持久化驱动
    'driver' => \BusinessLogger\Driver\ThinkPHP\ThinkPHP::class,
    'map' => [
        '模型类名称' => [
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

默认会使用 NormalTypeHandler 记录

可以实现`BaseExtendedTypeHandler`接口，自定义处理方式

## 查询结果
```json
{
    "data": [
        {
            "id": 8,
            "app_name": "未命名",
            "object_name": "ProcessDef",
            "object_id": "1",
            "operator": "李总",
            "operation_name": "增加",
            "operation_alias": "增加一个流程",
            "extra_words": "开始增加流程",
            "comment": "加油去添加流程",
            "operation_time": "2021-02-02 18:14:44",
            "attributes": [
                {
                    "id": 12,
                    "operation_id": 8,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 13,
                    "operation_id": 8,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 14,
                    "operation_id": 8,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 7,
            "app_name": "未命名",
            "object_name": "app\\model\\ProcessDef",
            "object_id": "1",
            "operator": "周总",
            "operation_name": "增加",
            "operation_alias": "增加了流程图",
            "extra_words": "增加了流程图2",
            "comment": "流程图名称是：采购",
            "operation_time": "2021-02-02 18:14:44",
            "attributes": [
                {
                    "id": 11,
                    "operation_id": 7,
                    "attribute_type": "normal",
                    "attribute_name": "name",
                    "attribute_alias": "name",
                    "old_value": "采购",
                    "new_value": "1612260884",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 6,
            "app_name": "未命名",
            "object_name": "ProcessDef",
            "object_id": "1",
            "operator": "李总",
            "operation_name": "增加",
            "operation_alias": "增加一个流程",
            "extra_words": "开始增加流程",
            "comment": "加油去添加流程",
            "operation_time": "2021-02-02 16:54:03",
            "attributes": [
                {
                    "id": 8,
                    "operation_id": 6,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 9,
                    "operation_id": 6,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 10,
                    "operation_id": 6,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 5,
            "app_name": "未命名",
            "object_name": "app\\model\\ProcessDef",
            "object_id": "1",
            "operator": "周总",
            "operation_name": "增加",
            "operation_alias": "增加了流程图",
            "extra_words": "增加了流程图2",
            "comment": "流程图名称是：采购",
            "operation_time": "2021-02-02 16:54:03",
            "attributes": [
                {
                    "id": 7,
                    "operation_id": 5,
                    "attribute_type": "normal",
                    "attribute_name": "name",
                    "attribute_alias": "name",
                    "old_value": "采购",
                    "new_value": "1612256043",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 4,
            "app_name": "未命名",
            "object_name": "ProcessDef",
            "object_id": "1",
            "operator": "李总",
            "operation_name": "增加",
            "operation_alias": "增加一个流程",
            "extra_words": "开始增加流程",
            "comment": "加油去添加流程",
            "operation_time": "2021-02-02 16:48:12",
            "attributes": [
                {
                    "id": 4,
                    "operation_id": 4,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 5,
                    "operation_id": 4,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                },
                {
                    "id": 6,
                    "operation_id": 4,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 3,
            "app_name": "未命名",
            "object_name": "app\\model\\ProcessDef",
            "object_id": "1",
            "operator": "周总",
            "operation_name": "增加",
            "operation_alias": "增加了流程图",
            "extra_words": "增加了流程图2",
            "comment": "流程图名称是：采购",
            "operation_time": "2021-02-02 16:48:12",
            "attributes": [
                {
                    "id": 3,
                    "operation_id": 3,
                    "attribute_type": "normal",
                    "attribute_name": "name",
                    "attribute_alias": "name",
                    "old_value": "采购",
                    "new_value": "1612255691",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 2,
            "app_name": "未命名",
            "object_name": "ProcessDef",
            "object_id": "1",
            "operator": "李总",
            "operation_name": "增加",
            "operation_alias": "增加一个流程",
            "extra_words": "开始增加流程",
            "comment": "加油去添加流程",
            "operation_time": "2021-02-02 16:28:46",
            "attributes": [
                {
                    "id": 2,
                    "operation_id": 2,
                    "attribute_type": "normal",
                    "attribute_name": "status",
                    "attribute_alias": "Status",
                    "old_value": "TODO",
                    "new_value": "Doing",
                    "diff_value": ""
                }
            ]
        },
        {
            "id": 1,
            "app_name": "未命名",
            "object_name": "app\\model\\ProcessDef",
            "object_id": "1",
            "operator": "周总",
            "operation_name": "增加",
            "operation_alias": "增加了流程图",
            "extra_words": "增加了流程图2",
            "comment": "流程图名称是：采购",
            "operation_time": "2021-02-02 16:28:46",
            "attributes": [
                {
                    "id": 1,
                    "operation_id": 1,
                    "attribute_type": "normal",
                    "attribute_name": "name",
                    "attribute_alias": "name",
                    "old_value": "采购",
                    "new_value": "1612254526",
                    "diff_value": ""
                }
            ]
        }
    ],
    "meta": {
        "total": 8
    }
}
```

## composer 使用

包未发布到 composer，因此需要指定分支和版本dev-main(分支)#0.1.1(版本)

```json
{
  "require": {
    "ccb1900/business-logger": "dev-main#0.1.1"
  },
  "repositories": {
    "businiess-logger": {
      "type": "vcs",
      "url": "https://github.com/ccb1900/business-logger.git"
    }
  }
}
```
