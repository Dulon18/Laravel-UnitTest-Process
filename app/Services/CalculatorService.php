<?php

namespace App\Services;

class CalculatorService
{
    public function calculate($num1, $num2, $operation)
    {
        switch ($operation) {
            case 'add':
                return $num1 + $num2;
            case 'subtract':
                return $num1 - $num2;
            case 'multiply':
                return $num1 * $num2;
            case 'divide':
                return $num2 != 0 ? $num1 / $num2 : 'Division by zero!';
            default:
                return 'Invalid operation!';
        }
    }
}
