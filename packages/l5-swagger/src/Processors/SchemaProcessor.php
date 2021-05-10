<?php

namespace Mi\L5Swagger\Processors;

use Mi\L5Swagger\Types\ObjectType;


class SchemaProcessor extends AbstractProcessor
{
    public static function ruleToSchema($key, $rule, $allRules = [])
    {
        if (preg_match(self::REGEX_BOOLEAN, $rule)) {
            return self::toBooleanSchema($rule);
        }

        if (preg_match(self::REGEX_ARRAY_ITEM, $key)) {
            return null;
        }

        if (preg_match(self::REGEX_INT, $rule, $matches)) {
            return self::toIntSchema($rule, $matches);
        }

        if (preg_match(self::REGEX_FILE, $rule)) {
            return self::toFileSchema($rule);
        }

        if (preg_match(self::REGEX_ARRAY, $rule)) {
            return self::toArraySchema($key, $rule, $allRules);
        }

        if (preg_match(self::REGEX_DATE, $rule)) {
            return self::toDateTimeSchema($rule);
        }

        return self::toStringSchema($rule);
    }

    protected static function ruleToType($name)
    {
        return '\\Mi\\L5Swagger\\Types\\' . ucfirst($name) . 'Type';
    }

    protected static function toBooleanSchema($rule)
    {
        $type   = self::ruleToType('boolean');
        $schema = new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);

        return $schema;
    }

    protected static function toIntSchema($rule, $matches)
    {
        $type   = self::ruleToType($matches[1] == 'Price' ? 'long' : 'integer');
        $schema = new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);

        // detect min
        if (preg_match(self::REGEX_MIN, $rule, $min)) {
            $schema->minimum = (int)$min[1];
        }

        // detect max
        if (preg_match(self::REGEX_MAX, $rule, $max)) {
            $schema->maximum = (int)$max[1];
        }

        return $schema;
    }

    protected static function toStringSchema($rule)
    {
        // default is string
        $type   = self::ruleToType('string');
        $schema = new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);

        // detect min
        if (preg_match(self::REGEX_MIN, $rule, $min)) {
            $schema->minLength = (int)$min[1];
        }

        // detect max
        if (preg_match(self::REGEX_MAX, $rule, $max)) {
            $schema->maxLength = (int)$max[1];
        }

        return $schema;
    }

    protected static function toFileSchema($rule)
    {
        $type   = self::ruleToType('binary');
        $schema = new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);

        // detect min
        if (preg_match(self::REGEX_MIN, $rule, $min)) {
            $schema->minimum = (int)$min[1];
        }

        // detect max
        if (preg_match(self::REGEX_MAX, $rule, $max)) {
            $schema->maximum = (int)$max[1];
        }

        return $schema;
    }

    protected static function toArraySchema($key, $rule, $allRules)
    {
        $type   = self::ruleToType('array');
        $schema = new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);

        // Try to detect array of items
        foreach ($allRules as $k => $v) {
            if (preg_match('/' . $key . '\.\*$/', $k)) {
                $schema->item = self::ruleToSchema($key . '.item', $v);

                return $schema;
            }
        }

        // Try to detect type of object
        $object = new ObjectType();
        $allowKey = null;
        foreach ($allRules as $k => $v) {
            if (preg_match('/' . $key . '\.\*\.(\w+)/', $k, $matches)) {
                // Skip if key is sub array
                if (! is_null($allowKey) && strpos($k, $allowKey) !== false) {
                    continue;
                }

                // if type is Array, create sub array and excute
                if (preg_match(self::REGEX_ARRAY, $v)) {
                    $allowKey = $k;
                    $object->addProperty($matches[1], self::ruleToSchema($matches[1], $v, $allRules));
                    continue;
                }

                $object->addProperty($matches[1], self::ruleToSchema($key . '.item', $v));
            }

            if (preg_match('/' . $key . '\.(\w+)/', $k, $matches)) {
                // Skip if key is sub array
                if (! is_null($allowKey) && strpos($k, $allowKey) !== false) {
                    continue;
                }

                // if type is Array, create sub array and excute
                if (preg_match(self::REGEX_ARRAY, $v)) {
                    $allowKey = $k;
                    $object->addProperty($matches[1], self::ruleToSchema($matches[1], $v, $allRules));
                    continue;
                }

                $object->addProperty($matches[1], self::ruleToSchema($key . '.item', $v));
            }
        }

        if (count($object->properties) == 0) {
            return null;
        }

        $schema->item = $object;

        return $schema;
    }

    protected static function toDateTimeSchema($rule)
    {
        $type = self::ruleToType('DateTime');

        // TODO: add logic for min / max
        return new $type([
            'required' => (bool)preg_match(self::REGEX_REQUIRED, $rule)
        ]);
    }
}
