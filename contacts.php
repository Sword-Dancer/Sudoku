<?
require_once '/classes/AutoLoading.php';
$obApp = new Application("/templates/top_menu.php", "/templates/footer.php");
?>
<html>
<head>
    <title>Контакты</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="templates/styles/style.css">
</head>
<body>
    <? require_once $obApp->getTopMenuTemplate(); ?>

    <div class="text_wrapper">
        <a href="https://github.com/Sword-Dancer/Sudoku" target="_blank">Репозиторий</a> на GitHub
    </div>

    <? require_once $obApp->getFooterTemplate(); ?>
</body>
</html>