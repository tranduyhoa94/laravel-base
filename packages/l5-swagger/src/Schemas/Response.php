<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class Response extends AbstractSchema
{
    protected $status = 'default';

    protected $description = '';

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->only('description');
    }
}
