<?php

namespace Mi\L5Swagger\Types;

class ObjectType extends AbstractType
{
    /**
     * @var string
     */
    protected $type = self::TYPE_OBJECT;

    /**
     * @var Mi\L5Swagger\Types\AbstractType[]
     */
    protected $properties = [];

    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            $this->only('properties')
        );
    }

    public function addProperty(string $name, AbstractType $type)
    {
        $this->properties[$name] = $type;

        return $this;
    }
}
