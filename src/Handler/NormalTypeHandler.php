<?php

namespace BusinessLogger\Handler;

/**
 * 普通类型
 * Class NormalTypeHandler
 * @package BusinessLogger\Handler
 */
class NormalTypeHandler implements BaseExtendedTypeHandler
{

    public function handleAttributeChange(
        String $oldValue,
        String $newValue
    ): array {
        return [
            'old_value' => $oldValue,
            'diff_value' => '',
            'new_value' => $newValue,
        ];
    }

    public function getName():String
    {
        return 'normal';
    }
}
