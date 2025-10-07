<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Calculator with Unit Testing

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-10.x-green.svg)](https://phpunit.de)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A comprehensive Laravel calculator application demonstrating unit testing and feature testing best practices. This project implements basic arithmetic operations (addition, subtraction, multiplication, and division) with complete test coverage.

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [Code Overview](#code-overview)
- [Testing Approach](#testing-approach)
- [Test Cases](#test-cases)
- [Understanding the Tests](#understanding-the-tests)
- [Best Practices Demonstrated](#best-practices-demonstrated)
- [Contributing](#contributing)
- [License](#license)

## 🎯 About

This project demonstrates how to implement comprehensive testing strategies in Laravel applications through a simple calculator application. It covers both:
- **Unit Tests**: Testing the CalculatorService in isolation
- **Feature Tests**: Testing the CalculatorController with HTTP requests

Perfect for learning Test-Driven Development (TDD) and understanding Laravel testing fundamentals.

## ✨ Features

- ➕ Addition
- ➖ Subtraction
- ✖️ Multiplication
- ➗ Division (with zero division handling)
- 🛡️ Input validation
- ✅ Complete unit test coverage
- 🧪 Feature tests for HTTP endpoints
- 📊 User-friendly web interface

## 🔧 Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 11.x
- Basic understanding of Laravel and PHPUnit

## 📥 Installation

1. **Clone the repository**
```bash
git clone https://github.com/Dulon18/Laravel-UnitTest-Process.git
cd Laravel-UnitTest-Process
```

2. **Install dependencies**
```bash
composer install
```

3. **Create environment file**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Start the development server**
```bash
php artisan serve
```

6. **Access the application**
```
http://localhost:8000/calculator
```

## 📁 Project Structure

```
Laravel-UnitTest-Process/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── CalculatorController.php    # Handles calculator HTTP requests
│   └── Services/
│       └── CalculatorService.php           # Business logic for calculations
├── tests/
│   ├── Feature/
│   │   └── CalculatorControllerTest.php    # Feature tests for controller
│   └── Unit/
│       └── CalculatorServiceTest.php       # Unit tests for service
├── resources/
│   └── views/
│       └── calculator.blade.php            # Calculator UI
└── routes/
    └── web.php                             # Application routes
```

## 🚀 Running the Application

### Access the Calculator

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Open your browser and navigate to:
```
http://localhost:8000/calculator
```

3. Enter two numbers, select an operation, and click calculate!

### Available Routes

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/calculator` | `index` | Display calculator form |
| POST | `/calculator` | `calculate` | Process calculation |

## 🧪 Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suite
```bash
# Run only unit tests
php artisan test --testsuite=Unit

# Run only feature tests
php artisan test --testsuite=Feature
```

### Run Specific Test File
```bash
# Run CalculatorService unit tests
php artisan test tests/Unit/CalculatorServiceTest.php

# Run CalculatorController feature tests
php artisan test tests/Feature/CalculatorControllerTest.php
```

### Run Tests with Coverage
```bash
php artisan test --coverage
```

### Run Tests with Detailed Output
```bash
php artisan test --verbose
```

### Using PHPUnit Directly
```bash
./vendor/bin/phpunit
./vendor/bin/phpunit --filter test_addition_returns_correct_result
```

## 💻 Code Overview

### CalculatorController

The controller handles HTTP requests and returns views:

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(Request $request)
    {
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $operation = $request->input('operation');
        
        $result = null;
        
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                $result = $num2 != 0 ? $num1 / $num2 : 'Division by zero!';
                break;
            default:
                $result = 'Invalid operation!';
        }
        
        return view('calculator', compact('num1', 'num2', 'operation', 'result'));
    }
}
```

### CalculatorService

The service contains the business logic for calculations:

```php
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
```

### Routes Configuration

```php
use App\Http\Controllers\CalculatorController;

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculate');
```

## 🔍 Testing Approach

### Unit Testing (CalculatorServiceTest)

Unit tests focus on testing the `CalculatorService` in isolation without any HTTP requests or database interactions.

**Location**: `tests/Unit/CalculatorServiceTest.php`

```php
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
        $calculator = new CalculatorService();
        $result = $calculator->calculate(5, 3, 'subtract');
        $this->assertEquals(2, $result, 'Subtraction result should be 2');
    }
    
    public function test_multiply_returns_correct_result()
    {
        $calculator = new CalculatorService();
        $result = $calculator->calculate(5, 3, 'multiply');
        $this->assertEquals(15, $result, 'Multiply result should be 15');
    }
    
    public function test_divide_returns_correct_result()
    {
        $calculator = new CalculatorService();
        $result = $calculator->calculate(15, 3, 'divide');
        $this->assertEquals(5, $result, 'Division result should be 5');
    }
    
    public function test_default_result()
    {
        $calculator = new CalculatorService();
        $result = $calculator->calculate(15, 3, '');
        $this->assertEquals('Invalid operation!', $result, 'Default result return correct..');
    }
}
```

### Feature Testing (CalculatorControllerTest)

Feature tests verify the complete HTTP flow including routing, controller, and view rendering.

**Location**: `tests/Feature/CalculatorControllerTest.php`

```php
<?php
namespace Tests\Feature;

use Tests\TestCase;

class CalculatorControllerTest extends TestCase
{
    public function test_calculator_page_loads_successfully()
    {
        $response = $this->get('/calculator');
        $response->assertStatus(200);
        $response->assertViewIs('calculator');
    }
    
    public function test_addition_works_correctly()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 5,
            'operation' => 'add'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('15');
    }
    
    public function test_subtraction_works_correctly()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 5,
            'operation' => 'subtract'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('5');
    }
    
    public function test_multiplication_works_correctly()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 5,
            'operation' => 'multiply'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('50');
    }
    
    public function test_division_works_correctly()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 5,
            'operation' => 'divide'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('2');
    }
    
    public function test_division_by_zero_returns_error()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 0,
            'operation' => 'divide'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Division by zero!');
    }
    
    public function test_invalid_operation_returns_error()
    {
        $response = $this->post('/calculator', [
            'num1' => 10,
            'num2' => 5,
            'operation' => 'invalid'
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Invalid operation!');
    }
}
```

## 📊 Test Cases

### Unit Test Cases (5 Tests)

| Test Method | Input | Expected Output | Status |
|------------|-------|-----------------|--------|
| `test_addition_returns_correct_result` | 5, 3, 'add' | 8 | ✅ Pass |
| `test_subtract_returns_correct_result` | 5, 3, 'subtract' | 2 | ✅ Pass |
| `test_multiply_returns_correct_result` | 5, 3, 'multiply' | 15 | ✅ Pass |
| `test_divide_returns_correct_result` | 15, 3, 'divide' | 5 | ✅ Pass |
| `test_default_result` | 15, 3, '' | 'Invalid operation!' | ✅ Pass |

### Feature Test Cases (7 Tests)

| Test Method | Description | Expected Result |
|------------|-------------|-----------------|
| `test_calculator_page_loads_successfully` | GET /calculator | Status 200, View loaded |
| `test_addition_works_correctly` | POST 10 + 5 | Result: 15 |
| `test_subtraction_works_correctly` | POST 10 - 5 | Result: 5 |
| `test_multiplication_works_correctly` | POST 10 × 5 | Result: 50 |
| `test_division_works_correctly` | POST 10 ÷ 5 | Result: 2 |
| `test_division_by_zero_returns_error` | POST 10 ÷ 0 | Error message |
| `test_invalid_operation_returns_error` | POST invalid operation | Error message |

## 📚 Understanding the Tests

### The AAA Pattern

All tests follow the **Arrange-Act-Assert** pattern:

1. **Arrange** (প্রস্তুতি): Set up test data and dependencies
```php
$calculator = new CalculatorService();
```

2. **Act** (কাজ): Execute the code being tested
```php
$result = $calculator->calculate(5, 3, 'add');
```

3. **Assert** (যাচাই): Verify the results
```php
$this->assertEquals(8, $result, 'Addition result should be 8');
```

### Test Naming Convention

Tests use descriptive names that explain:
- What is being tested
- Under what conditions
- What is expected

Example: `test_addition_returns_correct_result`

### Assertions Used

| Assertion | Purpose |
|-----------|---------|
| `assertEquals()` | Verify exact value match |
| `assertStatus()` | Check HTTP status code |
| `assertViewIs()` | Verify correct view is returned |
| `assertSee()` | Check if text appears in response |

## 🎓 Best Practices Demonstrated

### 1. **Separation of Concerns**
- Controller handles HTTP requests
- Service handles business logic
- Tests are separated into Unit and Feature

### 2. **Single Responsibility**
- Each test method tests one specific scenario
- Each function has a single, clear purpose

### 3. **Meaningful Test Names**
- Test names clearly describe what they're testing
- Uses `test_` prefix for automatic discovery

### 4. **Edge Case Testing**
- Division by zero handling
- Invalid operation handling
- Default/empty input handling

### 5. **Complete Test Coverage**
- All operations are tested
- Both success and error cases covered
- Both unit and integration levels tested

### 6. **Code Reusability**
- CalculatorService can be used anywhere in the application
- Controller is thin and delegates to service layer

## 🔄 Test Execution Flow

```
User Request → Route → Controller → Service → Return Result
     ↓            ↓         ↓           ↓          ↓
     ✓            ✓         ✓           ✓          ✓
Feature Tests   Unit Tests
```

## 📈 Adding More Tests

To add a new test case:

1. **For Unit Tests** (`tests/Unit/CalculatorServiceTest.php`):
```php
public function test_your_new_test()
{
    // Arrange
    $calculator = new CalculatorService();
    
    // Act
    $result = $calculator->calculate($num1, $num2, $operation);
    
    // Assert
    $this->assertEquals($expected, $result);
}
```

2. **For Feature Tests** (`tests/Feature/CalculatorControllerTest.php`):
```php
public function test_your_feature_test()
{
    $response = $this->post('/calculator', [
        'num1' => 10,
        'num2' => 5,
        'operation' => 'add'
    ]);
    
    $response->assertStatus(200);
    $response->assertSee('15');
}
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/YourFeature`
3. Write tests for your changes
4. Ensure all tests pass: `php artisan test`
5. Commit your changes: `git commit -m 'Add some feature'`
6. Push to the branch: `git push origin feature/YourFeature`
7. Open a Pull Request

## 📖 Learning Resources

### Laravel Testing Documentation
- [Laravel Testing Guide](https://laravel.com/docs/testing)
- [HTTP Tests](https://laravel.com/docs/http-tests)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)

### Video Tutorials
- [Laracasts - Testing Laravel](https://laracasts.com/topics/testing)
- [Laravel Testing Best Practices](https://laravel-news.com/testing-best-practices)

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Author

**Dulon18**

- GitHub: [@Dulon18](https://github.com/Dulon18)
- Repository: [Laravel-UnitTest-Process](https://github.com/Dulon18/Laravel-UnitTest-Process)

## 🌟 Support

If you find this project helpful, please give it a ⭐️ on GitHub!

For questions or issues, please open an issue on the repository.

---

**Happy Testing! 🚀**

Learn, Build, Test, Deploy ✨

