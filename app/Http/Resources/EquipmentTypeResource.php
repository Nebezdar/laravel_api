<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'serial_number_mask' => $this->serial_number_mask,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'equipment' => EquipmentResource::collection($this->whenLoaded('equipment'))
        ];
    }
}
