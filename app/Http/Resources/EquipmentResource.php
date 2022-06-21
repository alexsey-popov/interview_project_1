<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'equipment_type' => new EquipmentTypeResource($this->equipmentType),
            'serial_number' => $this->serial_number,
            'notes' => $this->notes,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
        //return parent::toArray($request);
    }
}
