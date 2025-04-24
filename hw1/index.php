<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2.1.Домашняя работа: Hello, World!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img class="logo" src="https://mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg" alt="">
        <h1>2.1.Домашняя работа: Hello, World!</h1>
    </header>
    <main>
        <div class="greeting">
            <?php
                $hour = date('H');
                $greeting = ($hour < 12) ? 'Доброе утро' : (($hour < 18) ? 'Добрый день' : 'Добрый вечер');
                echo "<h2>$greeting, Мир!</h2>";
            ?>
        </div>
    </main>

    <footer>
        Задание для самостоятельной работы «Hello, World!»
    </footer>
</body>
</html>