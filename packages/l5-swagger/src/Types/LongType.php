<?php

namespace Mi\L5Swagger\Types;

class LongType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_INTEGER;

    /**
     * @var string
     */
    protected $format = self::FORMAT_INT64;
}
