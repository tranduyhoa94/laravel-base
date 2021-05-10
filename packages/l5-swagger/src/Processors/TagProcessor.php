<?php

namespace Mi\L5Swagger\Processors;

use Illuminate\Support\Str;

class TagProcessor extends AbstractProcessor
{
    public static function parseTag($name)
    {
        if (empty($name)) {
            return 'default';
        }

        // TODO: add depth
        $depth  = 2;
        $parts  = explode('.', $name);
        $result = [];

        if (isset($parts[1])) {
            return ucwords(str_replace('-', ' ', Str::singular($parts[1])));
        }

        return 'default';
        // for ($i = 0; $i < $depth; $i ++) {
        //     if (array_key_exists($i, $parts)) {
        //         $result[] = ucwords(str_replace('-', ' ', Str::singular($parts[$i])));
        //     }
        // }

        // return $result;
    }
}
