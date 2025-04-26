<?php
$equation = "X * 7 = 49";

$equation = str_replace(' ', '',$equation);

$op_match = [];
preg_match('/[+\-*\/]/', $equation, $op_match);
$operator = $op_match[0];

list($left, $right) = explode('=', $equation);

$parts = explode($operator, $left);

if ($parts[0] == 'X') {
    $a = null;
    $b = $parts[1];
    $x_side = 'left';
} else {
    $a = $parts[0];
    $b = null;
    $x_side = 'right';
}

$result = (int)$right;

switch ($operator) {
    case '+':
        $x = ($a === null) ? $result - $b : $result - $a;
        break;
    case '-':
        if ($a === null) {
            $x = $result + $b;
        } else {
            $x = $a - $result;
        }
        break;
    case '*':
        $x = ($a === null) ? $result / $b : $result / $a;
        break;
    case '/':
        if ($a === null) {
            $x = $result * $b;
        } else { 
            $x = $a / $result;
        }
        break;
    default:
        $x = null;
}

echo "уравнение: X * 7 = 49<br>";
echo "оператор: $operator<br>";
echo "X = $x";
?>