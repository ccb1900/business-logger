<?php

namespace BusinessLogger;

use BusinessLogger\Driver\IDriver;
use BusinessLogger\Driver\ThinkPHP\ThinkPHP;
use BusinessLogger\Handler\NormalTypeHandler;
use Carbon\Carbon;
use ReflectionClass;
use ReflectionException;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

abstract class OperationLogUtil
{
    /**
     * 应用名称
     * @var String
     */
    private $appName;
    /**
     * 类型映射
     * @var array|mixed
     */
    private $map;
    /**
     * @var IDriver
     */
    private $driver;

    public function __construct(array $config = [])
    {
        $this->appName = $config['app_name'] ?? '未命名';
        $this->map     = $config['map'] ?? [];
        $this->driver  = (new ReflectionClass($config['driver'] ?? ThinkPHP::class))->newInstance();
    }

    /**
     * 持久化到数据库
     * @param $operationModel
     * @param $attributes
     */
    private function add(array $operationModel, array $attributes)
    {
        $operationModel['operation_time'] = Carbon::now()->format('Y-m-d H:i:s');
        $operationModel['app_name']       = $this->getAppName();

        $this->driver->save($operationModel,$attributes);
    }

    /**
     * 直接记录属性
     * @param  string  $objectName
     * @param  string  $objectId
     * @param  string  $operator
     * @param  string  $operationName
     * @param  string  $operationAlias
     * @param  string  $extraWords
     * @param  string  $comment
     * @param $baseAttributeModelList
     */
    public function logAttributes(
        string $objectName,
        string $objectId,
        string $operator,
        string $operationName,
        string $operationAlias,
        string $extraWords,
        string $comment,
        $baseAttributeModelList
    ) {
        $this->add(
            [
                'object_name'     => $objectName,
                'object_id'       => $objectId,
                'operator'        => $operator,
                'operation_name'  => $operationName,
                'operation_alias' => $operationAlias,
                'extra_words'     => $extraWords,
                'comment'         => $comment
            ],
            $baseAttributeModelList
        );
    }

    /**
     * 记录新旧对象差异
     * @param  string  $objectId
     * @param  string  $operator
     * @param  string  $operationName
     * @param  string  $operationAlias
     * @param  string  $extraWords
     * @param  string  $comment
     * @param  string  $objectName
     * @param  array  $oldObject
     * @param  array  $newObject
     * @throws ReflectionException
     */
    public function logObject(
        string $objectId,
        string $operator,
        string $operationName,
        string $operationAlias,
        string $extraWords,
        string $comment,
        string $objectName,
        array $oldObject,
        array $newObject
    ) {
        $operation  = [
            'object_name'     => $objectName,
            'object_id'       => $objectId,
            'operator'        => $operator,
            'operation_name'  => $operationName,
            'operation_alias' => $operationAlias,
            'extra_words'     => $extraWords,
            'comment'         => $comment
        ];
        $attributes = [];
        foreach ($oldObject as $key => $value) {
            if ($value != $newObject[$key]) {
                // 如果配置了特殊处理类型
                if (isset($this->map[$objectName][$key])) {
                    // 反射实例化
                    $ref    = new ReflectionClass($this->map[$objectName][$key]['type']);
                    $object = $ref->newInstance();
                    // 调用对应的方法
                    $attribute = $ref->getMethod('handleAttributeChange')->invoke($object, [$value, $newObject[$key]]);
                } else {
                    $normal                      = new NormalTypeHandler();
                    $attribute                   = $normal->handleAttributeChange($value, $newObject[$key]);
                    $attribute['attribute_type'] = $normal->getName();
                }
                $attribute['attribute_alias'] = $this->map[$objectName][$key]['alias'] ?? $key;
                $attribute['attribute_name']  = $key;
                $attributes[]                 = $attribute;
            }
        }
        if (count($attributes) > 0) {
            $this->add($operation, $attributes);
        }
    }

    /**
     * 获取应用名称
     * @return mixed
     */
    private function getAppName(): string
    {
        return $this->appName;
    }

    /**
     * 查询日志内容
     * @param  array  $params
     * @return array
     */
    public function query(array $params)
    {
        return $this->driver->query($this->getAppName(),$params);
    }
}
