<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        $user = $request->user();

        if (!isset($user)) {
            return $this->defaultFields();
        }

        $method = Str::camel(class_basename($user)) . 'Fields';

        return array_merge($this->defaultFields(), $this->$method());
    }

    protected function defaultFields()
    {
        return [];
    }

    protected function studentFields()
    {
        return [];
    }

    protected function teacherFields()
    {
        return [];
    }

    protected function adminFields()
    {
        return [];
    }
}
