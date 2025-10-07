<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatorControllerTest extends TestCase
{
    public function user_can_add_two_numbers()
    {
        $response = $this->post('/calculator', [
            'num1' => 5,
            'num2' => 3,
            'operation' => 'add',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertViewHas('result', 8);
    }

    /** @test */
    public function user_can_subtract_two_numbers()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 4,
            'operation' => 'subtract',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertViewHas('result', 6);
    }

    /** @test */
    public function user_can_multiply_two_numbers()
    {
        $response = $this->post('/calculator', [
            'num1' => 7,
            'num2' => 6,
            'operation' => 'multiply',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertViewHas('result', 42);
    }

    /** @test */
    public function user_cannot_divide_by_zero()
    {
        $response = $this->post('/calculator', [
            'num1' => 5,
            'num2' => 0,
            'operation' => 'divide',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertViewHas('result', 'Division by zero!');
    }

    /** @test */
    public function invalid_operation_returns_error_message()
    {
        $response = $this->post('/calculator', [
            'num1' => 5,
            'num2' => 3,
            'operation' => 'modulus',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertViewHas('result', 'Invalid operation!');
    }
}
