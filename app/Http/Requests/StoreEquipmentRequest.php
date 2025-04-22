<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use App\Traits\SerialNumberValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEquipmentRequest extends FormRequest
{
    use SerialNumberValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'serial_number' => [
                'required',
                'string',
                $this->validateSerialNumber(),
                Rule::unique('equipment')->where(function ($query) {
                    return $query->where('equipment_type_id', $this->equipment_type_id);
                })
            ],
            'notes' => 'nullable|string'
        ];
    }

    private function validateSerialNumber()
    {
        return function ($attribute, $value, $fail) {
            $equipmentType = EquipmentType::find($this->equipment_type_id);
            if (!$this->checkSerialNumberFormat($value, $equipmentType->serial_number_mask)) {
                $fail('Серийный номер не соответствует маске типа оборудования.');
            }
        };
    }
}
