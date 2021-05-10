<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;
use Mi\L5Swagger\Types\AbstractType;

class RequestBody extends AbstractSchema
{
    const ACCEPT_JSON      = 'application/json';
    const ACCEPT_FORM_DATA = 'multipart/form-data';

    /**
     * @var string
     */
    protected $accept = self::ACCEPT_JSON;

    /**
     * @var \Mi\L5Swagger\Types\AbstractType
     */
    protected $schemas = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        if (! $this->hasSchema()) {
            return null;
        }

        return [
            'schema' => [
                'type'       => 'object',
                'properties' => $this->getAttribute('schemas'),
                'required'   => $this->required
            ]
        ];
    }

    /**
     * Add new schema to request body
     *
     * @param string $name
     * @param \Mi\L5Swagger\Contracts\TypeInterface $schema
     * @return self
     */
    public function addSchema(string $name, AbstractType $schema)
    {
        $this->schemas[$name] = $schema;

        return $this;
    }

    public function addRequired(string $name)
    {
        $this->required[] = $name;

        return $this;
    }

    public function hasSchema()
    {
        return count($this->schemas) > 0;
    }

    public function isJsonRequest()
    {
        return $this->accept == self::ACCEPT_JSON;
    }

    public function isFormDataRequest()
    {
        return $this->accept == self::ACCEPT_FORM_DATA;
    }
}
