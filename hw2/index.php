<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4.1. Домашняя работа: Feedback Form.</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img class="logo" src="https://mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg" alt="">
        <h1>4.1. Домашняя работа: Feedback Form.</h1>
    </header>

    <main>
        <form class="feedback-form" action="https://httpbin.org/post" method="post">
            <h2>Feedback Form</h2>
            <input type="text" id="name" name="name" required placeholder="Имя пользователя">
            <input type="email" id="email" name="email" required placeholder="Email">
            <select type="text" id="type" name="type" required placeholder="Тип обращения">
                <option value="" disabled selected>Тип обращения</option>    
                <option value="complaint">Жалоба</option>
                <option value="suggestion">Предложение</option>
                <option value="gratitude">Благодарность</option>
            </select>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Сообщение"></textarea>

            <div class="answer-options">
                <p>Вариант ответа</p>
                <label>
                    <input type="checkbox" name="answer[]" value="sms">
                    <span>SMS</span>
                </label>
                <label>
                    <input type="checkbox" name="answer[]" value="email">
                    <span>Email</span>
                </label>
            </div>
            <button type="submit">Отправить</button>
        </form>
        <a href="headers.php" class="page-link">Перейти на страницу с заголовками</a>
    </main>

    <footer>
        Задание для самостоятельной работы «Feedback Form.»
    </footer>
</body>
</html>