<?php

namespace Mi\L5Swagger\Types;

class ByteType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STRING;

    /**
     * @var string
     */
    protected $format = self::FORMAT_BYTE;
}
