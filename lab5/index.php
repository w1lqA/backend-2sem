<?php
include_once 'menu.php';
include_once 'viewer.php';
include_once 'add.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'view';
$content = '';

switch ($page) {
    case 'view':
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
        $p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $content = getViewer($sort, $p);
        break;
            
    case 'add':
        $content = getAddForm();
        break;

    default:
        $content = getViewer();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php echo getMenu(); ?>
    <div class="content">
        <?php echo $content; ?>
    </div>
</body>
</html>