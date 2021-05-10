<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class SecurityScheme extends AbstractSchema
{
    const TYPE_HTTP     = 'http';
    const SCHEME_BEARER = 'bearer';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->only('type', 'scheme');
    }
}
