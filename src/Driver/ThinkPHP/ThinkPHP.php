<?php

namespace BusinessLogger\Driver\ThinkPHP;

use BusinessLogger\Driver\IDriver;

class ThinkPHP implements IDriver
{

    public function save($operation, $attributes)
    {
        $operation = Operation::create($operation);

        foreach ($attributes as &$item) {
            $item['operation_id'] = $operation->id;
        }
        OperationAttribute::insertAll($attributes);
    }

    public function query($appName,array $params)
    {
        $operations   = Operation::where('app_name', $appName)->order('id desc')->paginate();
        $operationIds = collect($operations->items())->column('id');
        $attributes   = OperationAttribute::whereIn('operation_id', $operationIds)->select()->toArray();

        $operationMap = [];
        foreach ($attributes as $attribute) {
            $operationMap[$attribute['operation_id']][] = $attribute;
        }

        $results = [];
        foreach ($operations->items() as $item) {
            $item['attributes'] = [];
            if (isset($operationMap[$item['id']])) {
                $item['attributes'] = $operationMap[$item['id']];
            }
            $results[] = $item;
        }

        return [
            'data' => $results,
            'meta' => [
                'total' => $operations->total()
            ]
        ];
    }
}
