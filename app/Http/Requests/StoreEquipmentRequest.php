<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEquipmentRequest extends FormRequest
{
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

    private function checkSerialNumberFormat($serialNumber, $mask)
    {
        if (strlen($serialNumber) !== strlen($mask)) {
            return false;
        }

        for ($i = 0; $i < strlen($mask); $i++) {
            $char = $serialNumber[$i];
            switch ($mask[$i]) {
                case 'N':
                    if (!is_numeric($char)) return false;
                    break;
                case 'A':
                    if (!preg_match('/^[A-Z]$/', $char)) return false;
                    break;
                case 'a':
                    if (!preg_match('/^[a-z]$/', $char)) return false;
                    break;
                case 'X':
                    if (!preg_match('/^[A-Z0-9]$/', $char)) return false;
                    break;
                case 'Z':
                    if (!in_array($char, ['-', '_', '@'])) return false;
                    break;
                default:
                    return false;
            }
        }

        return true;
    }
}
