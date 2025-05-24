<?php
require_once 'dbconfig.php';

function getDeleteForm() {
    $db = getDBConnection();
    $message = '';
    
    if (isset($_GET['id'])) {
        try {
            $stmt = $db->prepare("SELECT lastname FROM contacts WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt = $db->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            
            $message = '<div class="message success">Запись с фамилией ' . htmlspecialchars($contact['lastname']) . ' удалена</div>';
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка при удалении записи</div>';
        }
    }
    
    $stmt = $db->query("SELECT id, lastname, firstname, middlename FROM contacts ORDER BY lastname, firstname");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = $message;
    $html .= '<div class="contact-list">';
    
    foreach ($contacts as $contact) {
        $initials = mb_substr($contact['firstname'], 0, 1) . '.';
        if (!empty($contact['middlename'])) {
            $initials .= mb_substr($contact['middlename'], 0, 1) . '.';
        }
        
        $html .= "<a href='index.php?page=delete&id={$contact['id']}'>";
        $html .= htmlspecialchars($contact['lastname'] . ' ' . $initials);
        $html .= '</a><br>';
    }
    
    $html .= '</div>';
    
    return $html;
} 