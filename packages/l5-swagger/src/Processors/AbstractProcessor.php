<?php

namespace Mi\L5Swagger\Processors;

class AbstractProcessor
{
    const REGEX_INT        = '/(?<=^|\|)(int(eger)?|PositiveInt32|Price)(?=\||$)/';
    const REGEX_FILE       = '/(?<=^|\|)(file|image)(?=\||$)/';
    const REGEX_MIN        = '/(?<=^|\|)min:(\d+)(?=\||$)/';
    const REGEX_MAX        = '/(?<=^|\|)max:(\d+)(?=\||$)/';
    const REGEX_REQUIRED   = '/(?<=^|\|)required(?=\||$)/';
    const REGEX_ARRAY      = '/(?<=^|\|)array(?=\||$)/';
    const REGEX_ARRAY_ITEM = '/\w+\.\*/';
    const REGEX_DATE       = '/(?<=^|\|)date(?=\||$)/';
    const REGEX_BOOLEAN    = '/(?<=^|\|)(bool(ean)?)(?=\||$)/';
}
