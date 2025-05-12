<?php 
    if (isset($_POST['num'])) {
        $num = $_POST['input'] . $_POST['num'];
    } else {
        $num = isset($_POST['input']) ? $_POST['input'] : "";
    }

    if (isset($_POST['op'])) {
        if (!empty($num)) {
            $num = $num . $_POST['op'];
        }
    }

    function evaluate($expr) {
        $expr = str_replace(' ', '', $expr);
        return parseExpression($expr);
    }
    
    function parseExpression($expr) {
        while (strpos($expr, '(') !== false) {
            $start = strrpos($expr, '(');
            $end = strpos($expr, ')', $start);
            if ($end === false) return "Ошибка: неверные скобки";
    
            $inner = substr($expr, $start + 1, $end - $start - 1);
            $value = parseExpression($inner);
            $expr = substr_replace($expr, $value, $start, $end - $start + 1);
        }
    
        $pattern = '/(-?\d+(\.\d+)?)([\+\-])(\d+(\.\d+)?)/';
        while (preg_match($pattern, $expr, $matches)) {
            $left = $matches[1];
            $op = $matches[3];
            $right = $matches[4];
            $result = ($op === '+') ? $left + $right : $left - $right;
            $expr = preg_replace($pattern, $result, $expr, 1);
        }
        $pattern = '/(-?\d+(\.\d+)?)([\*\/])(-?\d+(\.\d+)?)/';
        while (preg_match($pattern, $expr, $matches)) {
            $left = $matches[1];
            $op = $matches[3];
            $right = $matches[4];
            if ($op === '*' || $op === '/') {
                if ($op === '/' && $right == 0) return "Ошибка: деление на 0";
                $result = ($op === '*') ? $left * $right : $left / $right;
                $expr = preg_replace($pattern, $result, $expr, 1);
            }
        }
    
        return is_numeric($expr) ? $expr : "Ошибка";
    }
    if (isset($_POST['equal'])) {
        $allowed_chars = "0123456789+-*/().";
    
        $is_valid = true;
        for ($i = 0; $i < strlen($num); $i++) {
            if (strpos($allowed_chars, $num[$i]) === false) {
                $is_valid = false;
                break;
            }
        }
    
        if (!$is_valid) {
            $num = "Ошибка";
        } else {
            $num = evaluate($num);
        }
    }
    

    if (isset($_POST['clear'])) {
        $num = "";
    }

    if (isset($_POST['delete'])) {
        $num = substr($num, 0, -1);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #121212;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .calculator {
            width: 300px;
            background: #1e1e1e;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .display {
            width: 100%;
            height: 80px;
            margin-bottom: 20px;
            padding: 10px;
            background: #2d2d2d;
            border-radius: 8px;
            color: #e0e0e0;
            font-size: 2.2rem;
            text-align: right;
            border: none;
            outline: none;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .btn {
            height: 60px;
            border: none;
            border-radius: 8px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-number {
            background: #333;
            color: white;
        }

        .btn-number:hover {
            background: #444;
        }

        .btn-operator {
            background: #ff9500;
            color: white;
        }

        .btn-operator:hover {
            background: #ffaa33;
        }

        .btn-function {
            background: #a5a5a5;
            color: black;
        }

        .btn-function:hover {
            background: #d9d9d9;
        }

        .btn-equals {
            background: #ff9500;
            color: white;
        }

        .btn-equals:hover {
            background: #ffaa33;
        }

        .btn-clear {
            background: #a5a5a5;
            color: black;
        }

        .btn-clear:hover {
            background: #d9d9d9;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <form action="" method="post">
            <input type="text" class="display" name="input" value="<?php echo @$num ?>"> 
            <div class="buttons">
                <input type="submit" class="btn btn-function" name="clear" value="AC">
                <input type="submit" class="btn btn-function" name="delete" value="DEL">
                <input type="submit" class="btn btn-operator" name="op" value="/">
                <input type="submit" class="btn btn-operator" name="op" value="*">
                
                <input type="submit" class="btn btn-number" name="num" value="7">
                <input type="submit" class="btn btn-number" name="num" value="8">
                <input type="submit" class="btn btn-number" name="num" value="9">
                <input type="submit" class="btn btn-operator" name="op" value="-">
                
                <input type="submit" class="btn btn-number" name="num" value="4">
                <input type="submit" class="btn btn-number" name="num" value="5">
                <input type="submit" class="btn btn-number" name="num" value="6">
                <input type="submit" class="btn btn-operator" name="op" value="+">
                
                <input type="submit" class="btn btn-number" name="num" value="1">
                <input type="submit" class="btn btn-number" name="num" value="2">
                <input type="submit" class="btn btn-number" name="num" value="3">
                <input type="submit" class="btn btn-equals" name="equal" value="=">
                
                <input type="submit" class="btn btn-number" name="num" value=".">
                <input type="submit" class="btn btn-number" name="num" value="0">
                <input type="submit" class="btn btn-number" name="num" value="(">
                <input type="submit" class="btn btn-number" name="num" value=")">
            </div>
        </form>
    </div>
</body>
</html>