<!DOCTYPE html>
<html>
<head>
  <title>Simple Calculator</title>
  <style>
    body { font-family: Arial; background: #fcf9f8; display: flex; justify-content: center; align-items: center; height: 100vh; }
    form { background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input, select, button { margin: 5px 0; padding: 8px; width: 100%; }
    h2,h3 { text-align: center; color: brown}
    button{background: rgb(219, 102, 102);color: #fff;font-weight: bolder; border-radius: 0.8cm; border: 0;}
  </style>
</head>
<body>
  <form action="{{ route('calculate') }}" method="POST">
    @csrf
    <h2>Laravel Calculator</h2>
    <input type="number" name="num1" placeholder="Enter first number" value="{{ $num1 ?? '' }}" required>
    <input type="number" name="num2" placeholder="Enter second number" value="{{ $num2 ?? '' }}" required>

    <select name="operation" required>
      <option selected >Select operation</option>
      <option value="add" {{ (isset($operation) && $operation=='add') ? 'selected' : '' }}>+</option>
      <option value="subtract" {{ (isset($operation) && $operation=='subtract') ? 'selected' : '' }}>-</option>
      <option value="multiply" {{ (isset($operation) && $operation=='multiply') ? 'selected' : '' }}>x</option>
      <option value="divide" {{ (isset($operation) && $operation=='divide') ? 'selected' : '' }}>÷</option>
    </select>

    <button type="submit">Calculate</button>

    @if(isset($result))
      <h3>Result: {{ $result }}</h3>
    @endif
  </form>
</body>
</html>
