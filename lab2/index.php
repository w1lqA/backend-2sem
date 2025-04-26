<?php
echo "Болохонцев Виктор Андреевич 241-321 Лабораторная №2 <br><br>";

// 1
echo "Задание 1. GET-запрос <br>";
if (isset($_GET['num'])) {
    if ($_GET['num'] == 1) {
        echo "привет";
    } elseif ($_GET['num'] == 2) {
        echo "пока";
    } else {
        echo "Передано неизвестное число";
    }
} else {
    echo "Число не передано в GET-запросе";
}
echo "<br><br>";

// 2
echo "Задание 2. Двумерный массив <br>";
$array = [];
$counter = 1;
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $array[$i][$j] = $counter++;
    }
}
echo "<pre>";
print_r($array);
echo "</pre><br>";

// 3
echo "Задание 3. Сумма цифр года = 13 <br>";
function getDigitsSum($number) {
    $sum = 0;
    $digits = str_split($number);
    foreach ($digits as $digit) {
        $sum += $digit;
    }
    return $sum;
}
$years = [];
for ($year = 1; $year <= 2022; $year++) {
    if (getDigitsSum($year) == 13) {
        $years[] = $year;
    }
}
echo "Года, сумма цифр которых равна 13:<br>";
echo implode(', ', $years);
echo "<br><br>";

// 4
echo "Задание 4. array_search <br>";
$arr = ['a', '-', 'b', '-', 'c', '-', 'd'];
$pos = array_search('-', $arr);
echo "Позиция первого элемента '-': $pos<br><br>";

// 5 
echo "Задание 5. array_keys, array_values, array_combine <br>";
$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];
$combined = array_combine($keys, $values);
echo "<pre>";
print_r($combined);
echo "</pre>";

?>