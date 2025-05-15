<?php
include 'eval.php';

$expressionFile = 'expression.txt';
$num = "";

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

if (isset($_POST['equal'])) {
    $num = evaluateExpressionWithTrig($num);
}

if (isset($_POST['equal_from_file'])) {
    if (file_exists($expressionFile)) {
        $expr = file_get_contents($expressionFile);
        $num = evaluateExpressionWithTrig($expr);
    } else {
        $num = "Ошибка: файл не найден";
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
    <link rel="stylesheet" href="style.css">
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
                
                <input type="submit" class="btn btn-function btn-eval" name="equal_from_file" value="solve">


            </div>
        </form>
    </div>
</body>
</html>
