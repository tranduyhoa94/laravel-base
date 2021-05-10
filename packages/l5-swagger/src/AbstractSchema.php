<?php

namespace Mi\L5Swagger;

use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractSchema implements Arrayable
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $k => $v) {
            $this->$k = $v;
        }

        return $this;
    }

    /**
     * Get specific properties
     *
     * @param mixed $args
     * @return array
     */
    protected function only(...$args)
    {
        // TODO: add more logic + update approach
        $result = [];

        foreach ($args as $v) {
            if (null !== ($a = $this->getAttribute($v))) {
                $result[$v] = $a;
            }
        }

        return $result;
    }

    protected function getAttribute($key)
    {
        if ($this->$key instanceof self) {
            return $this->$key->toArray();
        }

        if (is_array($this->$key)) {
            return array_map(function ($x) {
                return $x instanceof self ? $x->toArray() : $x;
            }, $this->$key);
        }

        return $this->$key;
    }

    protected function setAttribute($key, $value)
    {
        // TODO: strict type
        $this->$key = $value;
    }

    public function __get($key)
    {
        if (property_exists(static::class, $key)) {
            return $this->$key;
        }

        return null;
    }

    public function __set($key, $value)
    {
        if (property_exists(static::class, $key)) {
            return $this->setAttribute($key, $value);
        }
    }
}
