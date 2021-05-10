<?php

namespace Mi\L5Swagger\Types;

class DoubleType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_NUMBER;

    /**
     * @var string
     */
    protected $format = self::FORMAT_DOUBLE;
}
