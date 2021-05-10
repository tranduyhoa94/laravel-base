<?php

namespace App\Http\Resources\Slot;

use App\Http\Resources\Appointment\AppointmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotResource extends JsonResource
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
        ]);

        $result['appointment'] = new AppointmentResource($this->whenLoaded('appointment'));

        return $result;
    }
}
