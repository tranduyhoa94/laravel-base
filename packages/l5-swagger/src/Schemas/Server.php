<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class Server extends AbstractSchema
{
    /**
     * @var string
     */
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->only('url');
    }
}
