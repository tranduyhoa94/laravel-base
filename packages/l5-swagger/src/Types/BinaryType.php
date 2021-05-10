<?php

namespace Mi\L5Swagger\Types;

class BinaryType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STRING;

    /**
     * @var string
     */
    protected $format = self::FORMAT_BINARY;

    /**
     * @var integer
     */
    protected $minimum;

    /**
     * @var integer
     */
    protected $maximum;
}
