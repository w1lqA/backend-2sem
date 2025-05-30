<?php
session_start();

// 1
if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = 'test';
    echo "Значение 'test' записано в сессию<br>";
} else {
    echo "Значение из сессии: " . $_SESSION['test'] . "<br>";
}

//3
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
    echo "Вы еще не обновляли страницу<br>";
} else {
    $_SESSION['counter']++;
    echo "Количество обновлений: " . $_SESSION['counter'] . "<br>";
}

//4
if (!isset($_POST['country'])) {
    echo '<form method="post">
        <label>Введите вашу страну:</label><br>
        <input type="text" name="country" required>
        <input type="submit" value="Отправить">
    </form>';
} else {
    $_SESSION['country'] = $_POST['country'];
    echo "Страна сохранена в сессии<br>";
}

//5
if (!isset($_SESSION['first_visit'])) {
    $_SESSION['first_visit'] = time();
    echo "Время первого захода записано<br>";
} else {
    $seconds_ago = time() - $_SESSION['first_visit'];
    echo "Прошло секунд с первого захода: " . $seconds_ago . "<br>";
}

//6
if (!isset($_POST['email'])) {
    echo '<form method="post">
        <label>Введите ваш email:</label><br>
        <input type="email" name="email" required>
        <input type="submit" value="Отправить">
    </form>';
} else {
    $_SESSION['email'] = $_POST['email'];
    echo '<form method="post">
        <label>Имя:</label><br>
        <input type="text" name="name" required><br>
        <label>Фамилия:</label><br>
        <input type="text" name="surname" required><br>
        <label>Пароль:</label><br>
        <input type="password" name="password" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="' . $_SESSION['email'] . '" required><br>
        <input type="submit" value="Отправить">
    </form>';
}

//7
if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 3600);
    echo "Кука 'test' создана<br>";
} else {
    echo "Значение куки 'test': " . $_COOKIE['test'] . "<br>";
    echo '<form method="post">
        <input type="submit" name="delete_cookie" value="Удалить куку">
    </form>';
}

//8
if (isset($_POST['delete_cookie'])) {
    setcookie('test', '', time() - 3600);
    echo "Кука 'test' удалена<br>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 9
if (!isset($_COOKIE['visits'])) {
    setcookie('visits', 1, time() + 3600 * 24 * 365);
    echo "Вы посетили наш сайт 1 раз!<br>";
} else {
    $visits = $_COOKIE['visits'] + 1;
    setcookie('visits', $visits, time() + 3600 * 24 * 365);
    echo "Вы посетили наш сайт " . $visits . " раз!<br>";
}

// 10
if (!isset($_POST['birthday'])) {
    echo '<form method="post">
        <label>Введите дату рождения:</label><br>
        <input type="date" name="birthday" required>
        <input type="submit" value="Отправить">
    </form>';
} else {
    $_SESSION['birthday'] = $_POST['birthday'];
    $birthday = new DateTime($_POST['birthday']);
    $today = new DateTime();
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));
    
    if ($birthday < $today) {
        $birthday->modify('+1 year');
    }
    
    $interval = $today->diff($birthday);
    if ($interval->days == 0) {
        echo "С Днем Рождения! 🎉<br>";
    } else {
        echo "До дня рождения осталось " . $interval->days . " дней<br>";
    }
}
?>
