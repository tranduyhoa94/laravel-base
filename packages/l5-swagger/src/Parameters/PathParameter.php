<?php

namespace Mi\L5Swagger\Parameters;

use Mi\L5Swagger\Types\StringType;

class PathParameter extends AbstractParameter
{
    /**
     * @var string
     */
    protected $in = self::IN_PATH;

    /**
     * @var boolean
     */
    protected $required = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->schema = new StringType();
    }
}
