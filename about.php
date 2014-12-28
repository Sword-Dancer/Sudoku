<?
require_once '/classes/AutoLoading.php';
$obApp = new Application("/templates/top_menu.php", "/templates/footer.php");
?>
<html>
<head>
    <title>О проекте</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="templates/styles/style.css">
</head>
<body>
    <? require_once $obApp->getTopMenuTemplate(); ?>

    <div class="text_wrapper">
        <h2>Что такое судоку</h2>
        <p>Судоку (яп. 数独 су:доку) — популярная головоломка с числами. В японском языке 数独 — это сокращение
            от 数字は独身に限る — цифры спасают от одиночества (незамужества, холостой жизни). Иногда судоку называют
            «магическим квадратом», что в общем-то неверно, так как судоку является латинским квадратом 9-го порядка.
            Судоку активно публикуют газеты и журналы разных стран мира, сборники судоку издаются большими тиражами.
            Решение судоку — популярный вид досуга.
        </p>

        <h2>Правила</h2>

        <p>Игровое поле представляет собой квадрат размером 9×9, разделённый на меньшие квадраты со стороной в 3 клетки.
        Таким образом, всё игровое поле состоит из 81 клетки. В них уже в начале игры стоят некоторые числа
        (от 1 до 9), называемые подсказками. От игрока требуется заполнить свободные клетки цифрами от 1 до 9 так,
        чтобы в каждой строке, в каждом столбце и в каждом малом квадрате 3×3 каждая цифра встречалась бы только один
        раз.</p>

        <p>Сложность судоку зависит не от количества изначально заполненных клеток, а от методов, которые нужно применять
        для её решения. Самые простые решаются дедуктивно: всегда есть хотя бы одна клетка, куда подходит только одно
        число. Некоторые головоломки можно решить за несколько минут, на другие можно потратить часы.</p>

        <p>Правильно составленная головоломка имеет только одно решение. Тем не менее, на некоторых сайтах в интернете
        под видом усложнённых головоломок пользователю предлагаются варианты судоку с несколькими вариантами решения,
        а также с ветвлениями самого хода решения.</p>

        <a href="https://ru.wikipedia.org/wiki/%D0%A1%D1%83%D0%B4%D0%BE%D0%BA%D1%83" target="_blank">Википедия</a>
    </div>

    <? require_once $obApp->getFooterTemplate(); ?>
</body>
</html>