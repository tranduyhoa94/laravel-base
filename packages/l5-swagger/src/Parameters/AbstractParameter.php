<?php

namespace Mi\L5Swagger\Parameters;

use Mi\L5Swagger\AbstractSchema;

abstract class AbstractParameter extends AbstractSchema
{
    const IN_PATH  = 'path';
    const IN_QUERY = 'query';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $in;

    /**
     * @var boolean
     */
    protected $required = false;

    /**
     * @var \Mi\L5Swagger\Types\AbstractType
     */
    protected $schema;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->only('name', 'in', 'required', 'schema');
    }
}
