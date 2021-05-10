<?php

namespace Mi\L5Swagger\Types;

class IntegerType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_INTEGER;

    /**
     * @var string
     */
    protected $format = self::FORMAT_INT32;

    /**
     * @var integer
     */
    protected $minimum = 1;

    /**
     * @var integer
     */
    protected $maximum = 2147483647;

    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            $this->only('minimum', 'maximum')
        );
    }
}
