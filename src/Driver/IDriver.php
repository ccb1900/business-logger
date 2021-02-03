<?php

namespace BusinessLogger\Driver;

interface IDriver
{
    /**
     * 持久化到数据库
     * @param $operation
     * @param $attributes
     * @return mixed
     */
    public function save($operation,$attributes);

    /**
     * 查询日志列表
     * @param  array  $params
     * @return mixed
     */
    public function query($appName, array $params);
}
