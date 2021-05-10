<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class Path extends AbstractSchema
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var \Mi\L5Swagger\Schemas\Operation[]
     */
    protected $operations;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($v) {
            return $v->toArray();
        }, $this->operations);
    }

    /**
     * Add new operation
     *
     * @param string $method
     * @param \Mi\L5Swagger\Schemas\Operation $operation
     * @return self
     */
    public function addOperation($method, $operation)
    {
        $this->operations[$method] = $operation;

        return $this;
    }
}
