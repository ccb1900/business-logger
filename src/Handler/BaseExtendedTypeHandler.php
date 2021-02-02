<?php

namespace BusinessLogger\Handler;

interface BaseExtendedTypeHandler
{
    /**
     * @param  String  $oldValue
     * @param  String  $newValue
     * @return mixed
     */
    public function handleAttributeChange(String $oldValue, String $newValue);

    /**
     * @return String
     */
    public function getName():String;
}
