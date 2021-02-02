<?php

namespace BusinessLogger\Handler;

/**
 * 富文本类型
 * Class RichTextTypeHandler
 * @package BusinessLogger\Handler
 */
class RichTextTypeHandler implements BaseExtendedTypeHandler
{

    public function handleAttributeChange(
        String $oldValue,
        String $newValue
    ): array {
        return [
            'old_value' => $oldValue,
            'diff_value' => $this->diff($oldValue,$newValue),
            'new_value' => $newValue,
        ];
    }

    public function getName():String
    {
        return 'rich_text';
    }

    private function diff($oldValue,$newValue):String
    {
        return "";
    }
}
