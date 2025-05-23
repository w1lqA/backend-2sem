<?php
function getMenu() {
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'view';
    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

    $menu = '<header class="menu">';

    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи',
    ];

    foreach ($menuItems as $page => $title) {
        $active = ($currentPage === $page) ? ' active' : '';
        $menu .= "<a href='index.php?page={$page}' class='{$active}'>{$title}</a>";
    };

    $menu .= '</header>';


    if ($currentPage === 'view') {
        $menu .= "<div class='submenu'>";

        $sortItems = [
            'default' => 'По умолчанию',
            'lastname' => 'По фамилии',
            'birth' => 'По дате рождения',
        ];
    
        foreach ($sortItems as $sort => $title) {
            $active = ($currentSort === $sort) ? ' active' : '';
            $menu .= "<a href='index.php?page=view&sort={$sort}' class='{$active}'>{$title}</a>";
        };

        $menu .= '</div>';

    }

    return $menu;
}