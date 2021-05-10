<?php

namespace Mi\L5Swagger\Types;

class DateType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STRING;

    /**
     * @var string
     */
    protected $format = self::FORMAT_DATE;
}
