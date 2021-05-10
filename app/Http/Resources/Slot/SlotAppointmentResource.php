<?php

namespace App\Http\Resources\Slot;

use Illuminate\Http\Resources\Json\JsonResource;

class SlotAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        $result = $this->resource->only([
            'id',
            'start_time',
            'end_time',
            'created_at'
        ]);

        return $result;
    }
}
