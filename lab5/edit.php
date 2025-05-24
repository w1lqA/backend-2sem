<?php
require_once 'dbconfig.php';

function getEditForm() {
    $db = getDBConnection();
    $message = '';
    $contact = null;
    
    $stmt = $db->query("SELECT id, lastname, firstname, middlename, gender, birthdate, phone, address, email, comment FROM contacts ORDER BY lastname, firstname");

    
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (isset($_GET['id'])) {
        $stmt = $db->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $stmt = $db->prepare("UPDATE contacts SET 
                lastname = :lastname,
                firstname = :firstname,
                middlename = :middlename,
                gender = :gender,
                birthdate = :birthdate,
                phone = :phone,
                address = :address,
                email = :email,
                comment = :comment
                WHERE id = :id");
            
            $stmt->execute([
                ':id' => $_POST['id'],
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
            
            $message = '<div class="message success">Запись обновлена</div>';
            $contact = null; 
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка: запись не обновлена</div>';
        }
    }
    
    $html = $message;
    
    $html = '<table class="contact-list">';
    $html .= '<tr>
        <th>ID</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Телефон</th>
        <th>Адрес</th>
        <th>Email</th>
        <th>Комментарий</th>
        <th>Изменить</th>
    </tr>';

    foreach ($contacts as $c) {
        $active = (isset($_GET['id']) && $_GET['id'] == $c['id']) ? ' active' : '';

        $html .= "<tr class='${active}'>";
                $html .= '<td>' . htmlspecialchars($c['id']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['lastname']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['firstname']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['middlename']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['gender']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['birthdate']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['phone']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['address']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['email']) . '</td>';
                $html .= '<td>' . htmlspecialchars($c['comment']) . '</td>';
                $html .= "<td class='edit-button-td'> <a href='index.php?page=edit&id={$c['id']}'>" . 'Изменить ✏️' .  "</a> </td>";
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    if ($contact) {
        $html .= '
        <style>
            dialog {
                padding: 0;
                border: none;
                background: none;
                margin: 0;
                width: auto;
                height: auto;
            }
            
            dialog::backdrop {
                background: rgba(0, 0, 0, 0.5);
            }
            
            .dialog form {
                background: white;
                padding: 2rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                position: relative;
            }

            .close-dialog-2 {
                background: none !important;
                border: none;
                width: 100%;
                max-width: 2rem;
                right: 0;
                top: 0;
                position: absolute;
                margin: 0;
                padding: 0;
                outline: none;
                font-size: 2rem;
                color: var(--secondary) !important;
            }

            .close-dialog-2:hover {
                color: var(--primary) !important;
                background-color: var(--bg) !important;
                transform: none !important;
            }

            .close-dialog {
                color: var(--primary);
                background-color: var(--bg);     
            }

            .close-dialog:hover {
                color: var(--bg);
            }
                
        </style>

        <dialog class="dialog">
            <form method="POST">
                <button type="button" class="close-dialog close-dialog-2">×</button>

                    <input type="hidden" name="id" value="' . $contact['id'] . '">
                    
                    <div class="form-group">
                        <label for="lastname">Фамилия:</label>
                        <input type="text" id="lastname" name="lastname" value="' . htmlspecialchars($contact['lastname']) . '" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="firstname">Имя:</label>
                        <input type="text" id="firstname" name="firstname" value="' . htmlspecialchars($contact['firstname']) . '" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="middlename">Отчество:</label>
                        <input type="text" id="middlename" name="middlename" value="' . htmlspecialchars($contact['middlename']) . '">
                    </div>
                    
                    <div class="form-group">
                        <label for="gender">Пол:</label>
                        <select id="gender" name="gender" required>
                            <option value="М"' . ($contact['gender'] == 'М' ? ' selected' : '') . '>М</option>
                            <option value="Ж"' . ($contact['gender'] == 'Ж' ? ' selected' : '') . '>Ж</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="birthdate">Дата рождения:</label>
                        <input type="date" id="birthdate" name="birthdate" value="' . $contact['birthdate'] . '" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Телефон:</label>
                        <input type="tel" id="phone" name="phone" value="' . htmlspecialchars($contact['phone']) . '" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Адрес:</label>
                        <textarea id="address" name="address">' . htmlspecialchars($contact['address']) . '</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="' . htmlspecialchars($contact['email']) . '">
                    </div>
                    
                    <div class="form-group">
                        <label for="comment">Комментарий:</label>
                        <textarea id="comment" name="comment">' . htmlspecialchars($contact['comment']) . '</textarea>
                    </div>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" class="close-dialog">Закрыть</button>
                </form>
            </dialog>
        </div>
        <script>    
            const dialog = document.querySelector(".dialog");
            const closeBtns = document.querySelectorAll(".close-dialog");

            window.addEventListener("load", () => {
                dialog.showModal();
            });

            closeBtns.forEach((closeBtn) => {
                closeBtn.addEventListener("click", () => {
                    dialog.close();
                });
            });
        </script>
        
        ';
    }
    
    return $html;
} 