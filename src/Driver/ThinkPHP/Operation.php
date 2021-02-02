<?php
declare (strict_types = 1);

namespace BusinessLogger\Driver\ThinkPHP;

use think\Model;

/**
 * @mixin \think\Model
 */
class Operation extends Model
{
    protected $table = 'operation';
}
