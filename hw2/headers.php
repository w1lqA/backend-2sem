<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4.1. Домашняя работа: Headers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img class="logo" src="https://mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg" alt="Логотип МосПолитеха">
        <h1>4.1. Домашняя работа: Headers</h1>
    </header>

    <main>
        <div class="headers-container">
            <h2>Заголовки главной страницы</h2>
            <textarea readonly rows="20" cols="80"><?php
$headers = get_headers('http://localhost/backend2sem/hw2/index.php');
if ($headers === false) {
    echo "Ошибка при получении заголовков для URL: " . $url;
} else {
    echo implode("\n", $headers);
}
?></textarea>
        </div>
        <a href="index.php" class="page-link">Вернуться к форме</a>
    </main>

    <footer>
        Задание для самостоятельной работы «Feedback Form.»
    </footer>
</body>
</html>