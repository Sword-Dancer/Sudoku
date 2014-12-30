<?
require_once '/classes/AutoLoading.php';
$obApp = new Application(
    "/templates/head.php",
    "/templates/top_menu.php",
    "/templates/footer.php"
);
?>
<html>
<head>
    <? require_once $obApp->getHeadTemplate(); ?>
    <title>Контакты</title>
</head>
<body>
    <? require_once $obApp->getTopMenuTemplate(); ?>

    <div class="text_wrapper">
        <a href="https://github.com/Sword-Dancer/Sudoku" target="_blank">Репозиторий</a> на GitHub
    </div>

    <? require_once $obApp->getFooterTemplate(); ?>
</body>
</html>