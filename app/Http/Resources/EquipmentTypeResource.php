<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Исключаем отношение equipment из ответа, так как:
        // 1. Это уменьшает размер ответа и нагрузку на базу данных
        // 2. При большом количестве оборудования это может существенно замедлить ответ
        // 3. Если нужен список оборудования, лучше использовать отдельный эндпоинт /api/equipment с фильтрацией по equipment_type_id
        return [
            'id' => $this->id,
            'name' => $this->name,
            'serial_number_mask' => $this->serial_number_mask,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
