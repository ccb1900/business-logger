<?php

/**
 * 示例配置文件
 */
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
