<?php
echo('№1. <br>');
file_put_contents('test.txt', '12345 <br><br>');
?>

<?php
$file = 'count.txt';
$count = file_exists($file) ? (int)file_get_contents($file) : 0;
$count++;
file_put_contents($file, $count);
echo "Страница обновлялась $count раз <br><br>";
?>

<?php
echo('№3. <br>');
if (file_exists('old.txt')) {
    rename('old.txt', 'new.txt');
    echo 'Файл переименован';
} else {
    echo 'Файл не существует <br><br>';
}
?>

<?php
echo('№4. <br>');

if (file_exists('test.txt')) {
    echo 'Файл test.txt существует';
} else {
    echo 'Файл test.txt не существует <br><br>';
}
?>

<?php
echo('№5. <br>');
$lines = file('test.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$sum = 0;

foreach ($lines as $number) {
    $sum += (int)$number;
}

file_put_contents('sum.txt', $sum);
echo "Сумма чисел: $sum  <br><br>";
?>