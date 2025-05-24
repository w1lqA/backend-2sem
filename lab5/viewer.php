<?php
require_once 'dbconfig.php';

function getViewer($sort = 'default', $page = 1) {
    $db = getDBConnection();
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    $orderBy = match($sort) {
        'lastname' => 'lastname ASC, firstname ASC',
        'birth' => 'birthdate ASC',
        default => 'created_at DESC'
    };

    $stmt = $db->query("SELECT COUNT(*) FROM contacts");
    $total = $stmt->fetchColumn();
    $totalPages = ceil($total / $perPage);

    $stmt = $db->prepare("SELECT * FROM contacts ORDER BY {$orderBy} LIMIT :offset, :perPage");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '<table>';
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
    </tr>';

    foreach ($contacts as $contact) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($contact['id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['lastname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['firstname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['middlename']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['birthdate']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['address']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['comment']) . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';

    if ($totalPages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? ' active' : '';
            $html .= "<a href='index.php?page=view&sort={$sort}&p={$i}' class='{$active}'>{$i}</a>";
        }
        $html .= '</div>';
    }

    return $html;
}