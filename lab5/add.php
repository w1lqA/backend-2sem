<?php
require_once 'dbconfig.php';

function getAddForm() {
    $message = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $db = getDBConnection();
            $stmt = $db->prepare("INSERT INTO contacts (lastname, firstname, middlename, gender, birthdate, phone, address, email, comment) 
                                  VALUES (:lastname, :firstname, :middlename, :gender, :birthdate, :phone, :address, :email, :comment)");
            $stmt->execute([
                ':lastname' => $_POST['lastname'],
                ':firstname' => $_POST['firstname'],
                ':middlename' => $_POST['middlename'],
                ':gender' => $_POST['gender'],
                ':birthdate' => $_POST['birthdate'],
                ':phone' => $_POST['phone'],
                ':address' => $_POST['address'],
                ':email' => $_POST['email'],
                ':comment' => $_POST['comment']
            ]);
            

            $message = '<div class="message success">Запись добавлена</div>';
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка при добавлении записи: ' . $e->getMessage() . '</div>';
        }
    }
    
    $html = $message;
    if ($message) {
        $html .= '<script>
            setTimeout(function() {
                var message = document.querySelector(".message");
                if (message) {
                    message.style.opacity = "0";
                    setTimeout(function() {
                        message.style.display = "none";
                    }, 500);
                }
            }, 3000);
        </script>';
    }

    $html .= '<form method="POST">
        <div class="form-group">
            <label for="lastname">Фамилия:</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        
        <div class="form-group">
            <label for="firstname">Имя:</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        
        <div class="form-group">
            <label for="middlename">Отчество:</label>
            <input type="text" id="middlename" name="middlename">
        </div>
        
        <div class="form-group">
            <label for="gender">Пол:</label>
            <select id="gender" name="gender" required>
                <option value="М">М</option>
                <option value="Ж">Ж</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="birthdate">Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
            <label for="address">Адрес:</label>
            <textarea id="address" name="address"></textarea>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        
        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment"></textarea>
        </div>
        
        <button type="submit">Добавить</button>
    </form>';

    return $html;
}