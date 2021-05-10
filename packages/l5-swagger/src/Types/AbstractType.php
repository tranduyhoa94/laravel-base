<?php

namespace Mi\L5Swagger\Types;

use Mi\L5Swagger\AbstractSchema;

abstract class AbstractType extends AbstractSchema
{
    const TYPE_INTEGER = 'integer';
    const TYPE_NUMBER  = 'number';
    const TYPE_STRING  = 'string';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_ARRAY   = 'array';
    const TYPE_OBJECT  = 'object';

    const FORMAT_INT32    = 'int32';
    const FORMAT_INT64    = 'int64';
    const FORMAT_FLOAT    = 'float';
    const FORMAT_DOUBLE   = 'double';
    const FORMAT_BYTE     = 'byte';
    const FORMAT_BINARY   = 'binary';
    const FORMAT_DATE     = 'date';
    const FORMAT_DATETIME = 'date-time';
    const FORMAT_PASSWORD = 'password';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var boolean
     */
    protected $required;

    public function toArray()
    {
        return $this->only('type', 'format');
    }
}
