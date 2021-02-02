<?php

namespace BusinessLogger\Handler;

/**
 * 资源类型，比如mp3,pdf等
 * Class ResourceTypeHandler
 * @package BusinessLogger\Handler
 */
class ResourceTypeHandler implements BaseExtendedTypeHandler
{

    public function handleAttributeChange(string $oldValue, string $newValue): array
    {
        return [
            'old_value' => $oldValue,
            'diff_value' => '',
            'new_value' => $newValue,
        ];
    }

    public function getName(): string
    {
        return 'resource';
    }
}
