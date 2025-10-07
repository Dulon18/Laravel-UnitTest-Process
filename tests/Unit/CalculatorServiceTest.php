<?php

namespace Tests\Unit;
use App\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function test_addition_returns_correct_result()
    {
        // Arrange: service object তৈরি করা
        $calculator = new CalculatorService();

        // Act: ফাংশন কল করা
        $result = $calculator->calculate(5, 3, 'add');

        // Assert: ফলাফল যাচাই করা
        $this->assertEquals(8, $result, 'Addition result should be 8');
    }
    public function test_subtract_returns_correct_result()
    {
        // Arrange: service object তৈরি করা
        $calculator = new CalculatorService();

        // Act: ফাংশন কল করা
        $result = $calculator->calculate(5, 3, 'subtract');

        // Assert: ফলাফল যাচাই করা
        $this->assertEquals(2, $result, 'Subtraction result should be 2');
    }
    public function test_multiply_returns_correct_result()
    {
        // Arrange: service object তৈরি করা
        $calculator = new CalculatorService();

        // Act: ফাংশন কল করা
        $result = $calculator->calculate(5, 3, 'multiply');

        // Assert: ফলাফল যাচাই করা
        $this->assertEquals(15, $result, 'Multiply result should be 15');
    }
    public function test_divide_returns_correct_result()
    {
        // Arrange: service object তৈরি করা
        $calculator = new CalculatorService();

        // Act: ফাংশন কল করা
        $result = $calculator->calculate(15, 3, 'divide');

        // Assert: ফলাফল যাচাই করা
        $this->assertEquals(5, $result, 'Division result should be 5');
    }
    public function test_default_result()
    {
        // Arrange: service object তৈরি করা
        $calculator = new CalculatorService();

        // Act: ফাংশন কল করা
        $result = $calculator->calculate(15, 3, '');

        // Assert: ফলাফল যাচাই করা
        $this->assertEquals('Invalid operation!', $result, 'Defult result retun correct..');
    }
}
