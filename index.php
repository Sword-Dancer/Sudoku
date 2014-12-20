<?
require_once '/classes/AutoLoading.php';

$obApp = new Application("/templates/top_menu.php", "/templates/footer.php");
$level = (int)$_GET['level'] ? (int)$_GET['level'] : 1;
$obSudoku = new Sudoku('/config.ini', $level);
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Судоку</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="jquery.json-2.4.js"></script>
	<script src="script.js"></script>

</head>
<body>
	<? require_once $obApp->getTopMenuTemplate(); ?>

    <div id="level">
        <div id="label">Уровень:</div>
        <a href="?level=1" id="level_1" <?if($level==1):?>class="select"<?endif?>>Простой</a>
        <a href="?level=2" id="level_2" <?if($level==2):?>class="select"<?endif?>>Средний</a>
        <a href="?level=3" id="level_3" <?if($level==3):?>class="select"<?endif?>>Сложный</a>
    </div>

	<div id="menu">
		<div id="clear">Очистить</div>
		<div id="save">Сохранить</div>
		<div id="load">Загрузить</div>
	</div>

	<br><br><br><br><br><br>

	<div id='nums'>
		<div class='off' id="pencil">&#9998;</div>
		<div class='num off' id="num_1">1</div>
		<div class='num off' id="num_2">2</div>
		<div class='num off' id="num_3">3</div>
		<div class='num off' id="num_4">4</div>
		<div class='num off' id="num_5">5</div>
		<div class='num off' id="num_6">6</div>
		<div class='num off' id="num_7">7</div>
		<div class='num off' id="num_8">8</div>
		<div class='num off' id="num_9">9</div>
		<div class='off' id="erase">&#9747;</div>
	</div>

	<div id='net_wrapper'>
		<table id='net'>
			<?$i=1;?>
			<?foreach ($obSudoku->getField() as $num => $x):?>
			<tr>
				<?foreach ($x as $y):?>
					<td
                        id="cell_<?=$i?>"
                        class="<?if($y):?>lock<?else:?>unlock<?endif;?><?if($i==1):?> active_cell<?endif;?>">
                        <?if($y):?>
                            <div data-type="big_num" data-num="<?=$y?>" id="big_num_<?=$i?>_<?=$y?>" class="big_num">
                                <?=$y?>
                            </div>
                        <?endif;?>
                    </td>
					<?$i++;?>
				<?endforeach;?>
			</tr>
			<?endforeach;?>
		</table>
	</div>

	<div id="hint">
		<ul>
			<li><b>Пробел</b> — режим карандаша (маленьких цифр)</li>
			<li><b>Х</b> — режим удаления</li>
			<li><b>1-9</b> — выбор цифры</li>
			<li><b>Стрелки</b> — выбор активной ячейки</li>
			<li><b>Enter</b> — вставка</li>
		</ul>
	</div>

    <? require_once $obApp->getFooterTemplate(); ?>

</body>
</html>

