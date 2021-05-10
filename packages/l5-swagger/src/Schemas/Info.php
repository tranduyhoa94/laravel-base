<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class Info extends AbstractSchema
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $version;

    public function __construct($title, $version)
    {
        $this->title   = $title;
        $this->version = $version;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->only('title', 'version');
    }
}
