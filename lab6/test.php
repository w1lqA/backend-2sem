<?php
session_start();

if (isset($_SESSION['test'])) {
    echo "Значение из сессии на странице test.php: " . $_SESSION['test'] . "<br>";
}

if (isset($_SESSION['country'])) {
    echo "Ваша страна: " . $_SESSION['country'] . "<br>";
} else {
    echo "Страна не указана. Пожалуйста, вернитесь на <a href='index.php'>главную страницу</a> и укажите страну.<br>";
}
?> 