<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class Reference extends AbstractSchema
{
    /**
     * @var string|int
     */
    protected $status = 'default';

    /**
     * @var string
     */
    protected $ref;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            '$ref' => $this->ref
        ];
    }
}
