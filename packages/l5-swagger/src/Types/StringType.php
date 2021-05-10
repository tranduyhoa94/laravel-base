<?php

namespace Mi\L5Swagger\Types;

class StringType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STRING;

    /**
     * @var integer
     */
    protected $minLength = 1;

    /**
     * @var integer
     */
    protected $maxLength = 255;

    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            $this->only('minLength', 'maxLength')
        );
    }
}
