<?php

namespace Mi\L5Swagger\Types;

class ArrayType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_ARRAY;

    /**
     * @var \Mi\L5Swagger\Types\AbstractType
     */
    protected $item;

    public function toArray()
    {
        return [
            'type' => $this->type,
            'items' => $this->getAttribute('item')
        ];
    }
}
