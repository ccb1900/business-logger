<?php
declare (strict_types = 1);

namespace BusinessLogger\Driver\ThinkPHP;

use think\Model;

/**
 * @mixin \think\Model
 */
class OperationAttribute extends Model
{
    protected $table = 'operation_attribute';
}
