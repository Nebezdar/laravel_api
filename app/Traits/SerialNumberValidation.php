<?php

namespace App\Traits;

trait SerialNumberValidation
{
    protected function checkSerialNumberFormat($serialNumber, $mask)
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
